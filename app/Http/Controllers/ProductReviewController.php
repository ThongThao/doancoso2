<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductReview;
use App\Models\Product;
use App\Models\Customer;

class ProductReviewController extends Controller
{
    // Get reviews for a product
    public function getProductReviews(Request $request, $productId)
    {
        $perPage = $request->get('per_page', 10);
        $sortBy = $request->get('sort_by', 'newest'); // newest, oldest, rating_high, rating_low, helpful
        $filterRating = $request->get('rating', null);

        $query = ProductReview::where('product_id', $productId)
            ->approved()
            ->with('customer:idCustomer,CustomerName,Avatar');

        // Filter by rating if specified
        if ($filterRating) {
            $query->where('rating', $filterRating);
        }

        // Sort reviews
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'rating_high':
                $query->orderBy('rating', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('rating', 'asc')->orderBy('created_at', 'desc');
                break;
            case 'helpful':
                $query->orderBy('helpful_count', 'desc')->orderBy('created_at', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
        }

        $reviews = $query->paginate($perPage);
        $stats = ProductReview::getProductStats($productId);

        return response()->json([
            'reviews' => $reviews,
            'stats' => $stats
        ]);
    }

    // Submit a new review
    public function submitReview(Request $request)
    {
        \Log::info('Review submission started', [
            'request_data' => $request->all(),
            'session_customer_id' => Session::get('idCustomer'),
            'session_all' => Session::all()
        ]);

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:product,idProduct',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:200',
            'review_text' => 'required|string|min:10|max:2000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max per image
        ]);

        if ($validator->fails()) {
            \Log::error('Review validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $customerId = Session::get('idCustomer');
        $productId = $request->product_id;

        \Log::info('Review validation passed', [
            'customer_id' => $customerId,
            'product_id' => $productId
        ]);

        // Check if customer is logged in
        if (!$customerId) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để đánh giá sản phẩm.'
            ], 401);
        }

        // Check if customer can review this product
        if (!ProductReview::canCustomerReview($productId, $customerId)) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chỉ có thể đánh giá sản phẩm đã mua và chưa đánh giá trước đó.'
            ], 403);
        }

        // Get customer info
        $customer = Customer::find($customerId);
        
        // Handle image uploads
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/reviews', $filename);
                $uploadedImages[] = $filename;
            }
        }

        // Check if this is a verified purchase
        // Status values: 0=Waiting, 1=Shipping, 2=Shipped, 99=Cancelled
        $isVerified = \DB::table('billinfo')
            ->join('bill', 'billinfo.idBill', '=', 'bill.idBill')
            ->where('billinfo.idProduct', $productId)
            ->where('bill.idCustomer', $customerId)
            ->whereIn('bill.Status', [1, 2]) // 1=Shipping, 2=Shipped (Đang giao hoặc đã giao)
            ->exists();

        // Create review
        $review = ProductReview::create([
            'product_id' => $productId,
            'customer_id' => $customerId,
            'customer_name' => $customer->CustomerName,
            'customer_email' => $customer->username ?? '', // Use username as email field doesn't exist
            'rating' => $request->rating,
            'title' => $request->title,
            'review_text' => $request->review_text,
            'images' => count($uploadedImages) > 0 ? $uploadedImages : null,
            'is_verified_purchase' => $isVerified,
            'verified_at' => $isVerified ? now() : null
        ]);

        \Log::info('Review created successfully', [
            'review_id' => $review->id,
            'customer_id' => $customerId,
            'product_id' => $productId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá của bạn đã được gửi thành công!',
            'review' => $review->load('customer:idCustomer,CustomerName,Avatar')
        ]);
    }

    // Mark review as helpful
    public function markHelpful(Request $request, $reviewId)
    {
        $customerId = Session::get('idCustomer');
        
        if (!$customerId) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để thực hiện hành động này.'
            ], 401);
        }

        $review = ProductReview::find($reviewId);
        
        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đánh giá.'
            ], 404);
        }

        $wasHelpful = $review->markHelpful($customerId);

        return response()->json([
            'success' => $wasHelpful,
            'message' => $wasHelpful ? 'Cảm ơn phản hồi của bạn!' : 'Bạn đã đánh giá đánh giá này rồi.',
            'helpful_count' => $review->helpful_count
        ]);
    }

    // Get review statistics for a product
    public function getReviewStats($productId)
    {
        $stats = ProductReview::getProductStats($productId);
        return response()->json($stats);
    }

    // Check if customer can review product
    public function canReview(Request $request, $productId)
    {
        $customerId = Session::get('idCustomer');
        
        \Log::info('Checking if customer can review', [
            'customer_id' => $customerId,
            'product_id' => $productId,
            'session_data' => Session::all()
        ]);
        
        if (!$customerId) {
            return response()->json([
                'can_review' => false,
                'reason' => 'Bạn cần đăng nhập để đánh giá sản phẩm.'
            ]);
        }

        $canReview = ProductReview::canCustomerReview($productId, $customerId);

        \Log::info('Can review result', [
            'can_review' => $canReview,
            'customer_id' => $customerId,
            'product_id' => $productId
        ]);

        return response()->json([
            'can_review' => $canReview,
            'reason' => $canReview ? '' : 'Bạn chỉ có thể đánh giá sản phẩm đã mua và chưa đánh giá trước đó.'
        ]);
    }
}

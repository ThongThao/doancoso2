<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';
    
    protected $fillable = [
        'product_id',
        'customer_id', 
        'customer_name',
        'customer_email',
        'rating',
        'title',
        'review_text',
        'images',
        'is_verified_purchase',
        'is_approved',
        'is_featured',
        'helpful_count',
        'helpful_users',
        'verified_at'
    ];

    protected $casts = [
        'images' => 'array',
        'helpful_users' => 'array',
        'is_verified_purchase' => 'boolean',
        'is_approved' => 'boolean', 
        'is_featured' => 'boolean',
        'verified_at' => 'datetime'
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'idProduct');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'idCustomer');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeVerifiedPurchase($query)
    {
        return $query->where('is_verified_purchase', true);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    // Static methods for statistics
    public static function getProductStats($productId)
    {
        $stats = self::where('product_id', $productId)
            ->where('is_approved', true)
            ->selectRaw('
                COUNT(*) as total_reviews,
                AVG(rating) as average_rating,
                SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
                SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
                SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
                SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
            ')
            ->first();

        return [
            'total_reviews' => $stats->total_reviews ?? 0,
            'average_rating' => round($stats->average_rating ?? 0, 1),
            'rating_distribution' => [
                5 => $stats->five_star ?? 0,
                4 => $stats->four_star ?? 0,
                3 => $stats->three_star ?? 0,
                2 => $stats->two_star ?? 0,
                1 => $stats->one_star ?? 0,
            ]
        ];
    }

    // Check if customer can review this product
    public static function canCustomerReview($productId, $customerId)
    {
        if (!$customerId) return false;

        // Check if customer has purchased this product
        // Status values: 0=Waiting, 1=Shipping, 2=Shipped, 99=Cancelled
        $hasPurchased = DB::table('billinfo')
            ->join('bill', 'billinfo.idBill', '=', 'bill.idBill')
            ->where('billinfo.idProduct', $productId)
            ->where('bill.idCustomer', $customerId)
            ->whereIn('bill.Status', [1, 2]) // 1=Shipping, 2=Shipped (Đang giao hoặc đã giao)
            ->exists();

        if (!$hasPurchased) return false;

        // Check if customer has already reviewed this product
        $hasReviewed = self::where('product_id', $productId)
            ->where('customer_id', $customerId)
            ->exists();

        return !$hasReviewed;
    }

    // Mark review as helpful by user
    public function markHelpful($userId)
    {
        $helpfulUsers = $this->helpful_users ?? [];
        
        if (!in_array($userId, $helpfulUsers)) {
            $helpfulUsers[] = $userId;
            $this->helpful_users = $helpfulUsers;
            $this->helpful_count = count($helpfulUsers);
            $this->save();
            return true;
        }
        
        return false;
    }

    // Check if user found this review helpful
    public function isHelpfulBy($userId)
    {
        $helpfulUsers = $this->helpful_users ?? [];
        return in_array($userId, $helpfulUsers);
    }
}

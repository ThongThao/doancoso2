<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Services\CassoService;
use App\Models\Bill;
use App\Models\BillInfo;
use App\Models\BillHistory;
use App\Models\Cart;
use App\Models\AddressCustomer;
use Illuminate\Support\Facades\DB;

class CassoPaymentController extends Controller
{
    protected $cassoService;

    public function __construct(CassoService $cassoService)
    {
        $this->cassoService = $cassoService;
    }

    /**
     * Tạo thanh toán VietQR
     */
    public function createVietQRPayment(Request $request)
    {
        try {
            $data = $request->all();
            
            // Validate required fields
            if (!isset($data['TotalBill']) || !isset($data['address_rdo'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thiếu thông tin thanh toán'
                ], 400);
            }

            $customerId = Session::get('idCustomer');
            if (!$customerId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thanh toán'
                ], 401);
            }

            // Tạo mã đơn hàng unique
            $orderId = 'DH' . time() . $customerId;
            $amount = (int)$data['TotalBill'];
            $description = "Thanh toan don hang {$orderId}";

            // Lưu thông tin đơn hàng tạm thời vào session
            Session::put('pending_order', [
                'order_id' => $orderId,
                'customer_id' => $customerId,
                'total_bill' => $amount,
                'address_id' => $data['address_rdo'],
                'created_at' => now()->toDateTimeString()
            ]);

            // Tạo mã QR VietQR
            $qrResult = $this->cassoService->generateVietQR($amount, $description, $orderId);

            if ($qrResult['success']) {
                return response()->json([
                    'success' => true,
                    'order_id' => $orderId,
                    'qr_code' => $qrResult['qr_code'],
                    'qr_data_url' => $qrResult['qr_data_url'],
                    'bank_info' => $qrResult['bank_info'],
                    'amount' => $amount,
                    'description' => $description,
                    'check_payment_url' => route('casso.check.payment', ['orderId' => $orderId])
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $qrResult['message'] ?? 'Không thể tạo mã QR thanh toán'
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Create VietQR Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống khi tạo thanh toán'
            ], 500);
        }
    }

    /**
     * Kiểm tra trạng thái thanh toán
     */
    public function checkPaymentStatus(Request $request, $orderId)
    {
        try {
            $pendingOrder = Session::get('pending_order');
            
            if (!$pendingOrder || $pendingOrder['order_id'] !== $orderId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }

            // Kiểm tra xem đơn hàng đã được xử lý chưa bằng cách kiểm tra OrderCode
            $existingBill = Bill::where('OrderCode', $orderId)->first();
            if ($existingBill) {
                return response()->json([
                    'success' => true,
                    'status' => 'completed',
                    'message' => 'Đơn hàng đã được thanh toán thành công',
                    'bill_id' => $existingBill->idBill
                ]);
            }

            $amount = $pendingOrder['total_bill'];
            $description = "Thanh toan don hang {$orderId}";
            
            // Kiểm tra trong vòng 10 phút gần nhất
            $fromDate = now()->subMinutes(10)->format('Y-m-d H:i:s');
            $toDate = now()->format('Y-m-d H:i:s');

            $checkResult = $this->cassoService->checkTransaction($amount, $description, $fromDate, $toDate);

            if ($checkResult['success'] && $checkResult['found']) {
                // Thanh toán thành công, tạo đơn hàng
                $billResult = $this->createOrderFromPendingPayment($pendingOrder, $checkResult['transaction']);
                
                if ($billResult['success']) {
                    // Xóa thông tin tạm thời
                    Session::forget('pending_order');
                    
                    return response()->json([
                        'success' => true,
                        'status' => 'completed',
                        'message' => 'Thanh toán thành công!',
                        'bill_id' => $billResult['bill_id'],
                        'redirect_url' => route('success.order')
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => $billResult['message']
                    ], 500);
                }
            } else {
                // Log để debug
                Log::info('Payment check result for order ' . $orderId, [
                    'amount' => $amount,
                    'description' => $description,
                    'check_result' => $checkResult,
                    'from_date' => $fromDate,
                    'to_date' => $toDate
                ]);
                
                return response()->json([
                    'success' => true,
                    'status' => 'pending',
                    'message' => 'Đang chờ thanh toán...'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Check Payment Status Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống khi kiểm tra thanh toán'
            ], 500);
        }
    }

    /**
     * Tạo đơn hàng từ thanh toán đang chờ
     */
    private function createOrderFromPendingPayment($pendingOrder, $transaction)
    {
        try {
            DB::beginTransaction();

            // Tạo Bill
            $address = AddressCustomer::find($pendingOrder['address_id']);
            
            $bill = new Bill();
            $bill->idCustomer = $pendingOrder['customer_id'];
            $bill->TotalBill = $pendingOrder['total_bill'];

            $bill->Address = $address->Address;
            $bill->PhoneNumber = $address->PhoneNumber;
            $bill->CustomerName = $address->CustomerName;
            $bill->Payment = 'casso_vietqr';
            $bill->OrderCode = $pendingOrder['order_id'];
            $bill->TransactionId = $transaction['id'] ?? null;
            $bill->Status = 1; // Đã thanh toán
            $bill->save();

            // Tạo BillHistory
            $billHistory = new BillHistory();
            $billHistory->idBill = $bill->idBill;
            $billHistory->Status = 1;
            $billHistory->Note = 'Thanh toán thành công qua Casso VietQR';
            $billHistory->save();

            // Lấy giỏ hàng và tạo BillInfo
            $cartItems = Cart::where('idCustomer', $pendingOrder['customer_id'])->get();

            foreach ($cartItems as $cart) {
                $billInfo = new BillInfo();
                $billInfo->idBill = $bill->idBill;
                $billInfo->idProduct = $cart->idProduct;
                $billInfo->AttributeProduct = $cart->AttributeProduct;
                $billInfo->Price = $cart->PriceNew;
                $billInfo->QuantityBuy = $cart->QuantityBuy;
                $billInfo->idProAttr = $cart->idProAttr;
                $billInfo->save();

                // Cập nhật số lượng sản phẩm
                DB::update('UPDATE product SET QuantityTotal = QuantityTotal - ? WHERE idProduct = ?', 
                    [$cart->QuantityBuy, $cart->idProduct]);
                DB::update('UPDATE product_attribute SET Quantity = Quantity - ? WHERE idProAttr = ?', 
                    [$cart->QuantityBuy, $cart->idProAttr]);
            }

            // Xóa giỏ hàng
            Cart::where('idCustomer', $pendingOrder['customer_id'])->delete();

            DB::commit();

            return [
                'success' => true,
                'bill_id' => $bill->idBill
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Create Order Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi khi tạo đơn hàng'
            ];
        }
    }

    /**
     * Webhook để nhận thông báo từ Casso
     */
    public function webhook(Request $request)
    {
        try {
            $data = $request->all();
            Log::info('Casso Webhook Data: ', $data);

            // Verify webhook signature if needed
            // $signature = $request->header('X-Signature');
            // if (!$this->verifyWebhookSignature($data, $signature)) {
            //     return response()->json(['message' => 'Invalid signature'], 401);
            // }

            // Process webhook data
            if (isset($data['data']) && is_array($data['data'])) {
                foreach ($data['data'] as $transaction) {
                    $this->processWebhookTransaction($transaction);
                }
            }

            return response()->json(['message' => 'OK'], 200);

        } catch (\Exception $e) {
            Log::error('Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }

    /**
     * Xử lý giao dịch từ webhook
     */
    private function processWebhookTransaction($transaction)
    {
        try {
            $description = $transaction['description'] ?? '';
            $amount = $transaction['amount'] ?? 0;

            // Extract order ID from description
            if (preg_match('/DH(\d+)/', $description, $matches)) {
                $orderId = 'DH' . $matches[1];
                
                // Check if order already exists
                $existingBill = Bill::where('OrderCode', $orderId)->first();
                if (!$existingBill) {
                    // Try to find pending order in session or database
                    // This part might need adjustment based on your session management
                    Log::info("New transaction for order: {$orderId}");
                }
            }

        } catch (\Exception $e) {
            Log::error('Process Webhook Transaction Error: ' . $e->getMessage());
        }
    }

    /**
     * Hủy thanh toán
     */
    public function cancelPayment(Request $request, $orderId)
    {
        try {
            $pendingOrder = Session::get('pending_order');
            
            if ($pendingOrder && $pendingOrder['order_id'] === $orderId) {
                Session::forget('pending_order');
                
                return response()->json([
                    'success' => true,
                    'message' => 'Đã hủy thanh toán'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng để hủy'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Cancel Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống'
            ], 500);
        }
    }
}

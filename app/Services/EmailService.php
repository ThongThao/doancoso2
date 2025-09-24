<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderConfirmationMail;
use App\Mail\InvoiceMail;
use App\Models\Bill;
use App\Models\BillInfo;
use App\Models\Customer;

class EmailService
{
    /**
     * Gửi email xác nhận đơn hàng (cho thanh toán khi nhận hàng)
     */
    public function sendOrderConfirmationEmail($billId)
    {
        try {
            $bill = Bill::with('customer')->find($billId);
            if (!$bill || !$bill->customer) {
                Log::warning("Cannot send confirmation email - Bill ID: {$billId}, Customer not found");
                return false;
            }

            // Kiểm tra email customer
            if (empty($bill->customer->Email)) {
                Log::info("Customer has no email address - Bill ID: {$billId}, using fallback email");
                // Có thể dùng email mặc định hoặc skip
                return false;
            }

            // Lấy thông tin chi tiết đơn hàng
            $billItems = BillInfo::with('product')->where('idBill', $billId)->get();
            
            // Tạo URL xác nhận
            $confirmUrl = url('/confirm-order/' . $billId . '?token=' . $this->generateOrderToken($billId));

            // Gửi email
            Mail::to($bill->customer->Email)->send(new OrderConfirmationMail($bill, $billItems, $confirmUrl));

            Log::info("Order confirmation email sent successfully - Bill ID: {$billId}");
            return true;

        } catch (\Exception $e) {
            Log::error("Failed to send order confirmation email - Bill ID: {$billId}, Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Gửi email hóa đơn
     */
    public function sendInvoiceEmail($billId)
    {
        try {
            $bill = Bill::with('customer')->find($billId);
            if (!$bill || !$bill->customer) {
                Log::warning("Cannot send invoice email - Bill ID: {$billId}, Customer not found");
                return false;
            }

            // Kiểm tra email customer
            if (empty($bill->customer->Email)) {
                Log::info("Customer has no email address - Bill ID: {$billId}, skipping invoice email");
                return false;
            }

            // Lấy thông tin chi tiết đơn hàng
            $billItems = BillInfo::with('product')->where('idBill', $billId)->get();

            // Gửi email
            Mail::to($bill->customer->Email)->send(new InvoiceMail($bill, $billItems));

            Log::info("Invoice email sent successfully - Bill ID: {$billId}");
            return true;

        } catch (\Exception $e) {
            Log::error("Failed to send invoice email - Bill ID: {$billId}, Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Tạo token xác nhận đơn hàng
     */
    private function generateOrderToken($billId)
    {
        return hash('sha256', $billId . config('app.key') . date('Y-m-d'));
    }

    /**
     * Xác minh token đơn hàng
     */
    public function verifyOrderToken($billId, $token)
    {
        $expectedToken = $this->generateOrderToken($billId);
        return hash_equals($expectedToken, $token);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Bill;
use App\Models\BillHistory;
use App\Services\EmailService;
use App\Services\AdminNotificationService;

class OrderConfirmationController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Xác nhận đơn hàng từ email
     */
    public function confirmOrder(Request $request, $billId)
    {
        $token = $request->get('token');
        
        if (!$token || !$this->emailService->verifyOrderToken($billId, $token)) {
            return view('emails.confirmation_error', [
                'message' => 'Link xác nhận không hợp lệ hoặc đã hết hạn.'
            ]);
        }

        $bill = Bill::find($billId);
        if (!$bill) {
            return view('emails.confirmation_error', [
                'message' => 'Không tìm thấy đơn hàng.'
            ]);
        }

        // Kiểm tra xem đơn hàng đã được xác nhận chưa
        if ($bill->Status != 0) {
            return view('emails.confirmation_success', [
                'bill' => $bill,
                'message' => 'Đơn hàng này đã được xác nhận trước đó.',
                'already_confirmed' => true
            ]);
        }

        // Cập nhật trạng thái đơn hàng thành "Đã xác nhận"
        $bill->Status = 1; // Đã xác nhận
        $bill->save();

        // Tạo lịch sử đơn hàng
        $billHistory = new BillHistory();
        $billHistory->idBill = $bill->idBill;
        $billHistory->Status = 1;
        $billHistory->Note = 'Đơn hàng được xác nhận bởi khách hàng qua email';
        $billHistory->AdminName = 'System';
        $billHistory->save();

        // Tạo thông báo cho admin
        $notificationService = new AdminNotificationService();
        $notificationService->createOrderStatusChangeNotification($bill->idBill, 0, 1);

        return view('emails.confirmation_success', [
            'bill' => $bill,
            'message' => 'Đơn hàng đã được xác nhận thành công!',
            'already_confirmed' => false
        ]);
    }
}

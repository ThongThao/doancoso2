<?php

namespace App\Services;

use App\Models\AdminNotification;
use App\Models\Bill;

class AdminNotificationService
{
    /**
     * Create a new order notification
     */
    public function createNewOrderNotification($billId)
    {
        $bill = Bill::with('customer:idCustomer,CustomerName,username')->find($billId);
        
        if (!$bill) {
            return false;
        }

        $customerName = $bill->customer->CustomerName ?? $bill->customer->username ?? 'Khách hàng';
        $totalBill = number_format($bill->TotalBill, 0, ',', '.');

        AdminNotification::create([
            'type' => 'new_order',
            'title' => 'Đơn hàng mới',
            'message' => "Có đơn hàng mới từ khách hàng {$customerName} với giá trị {$totalBill}đ",
            'data' => [
                'bill_id' => $bill->idBill,
                'customer_id' => $bill->idCustomer,
                'customer_name' => $customerName,
                'total_bill' => $bill->TotalBill,
                'payment_method' => $bill->Payment,
                'order_code' => $bill->OrderCode ?? null,
                'url' => url("/list-bill")
            ],
            'admin_id' => null // Notification for all admins
        ]);

        return true;
    }

    /**
     * Create order status change notification
     */
    public function createOrderStatusChangeNotification($billId, $oldStatus, $newStatus)
    {
        $bill = Bill::with('customer:idCustomer,CustomerName,username')->find($billId);
        
        if (!$bill) {
            return false;
        }

        $statusMessages = [
            0 => 'Chờ xác nhận',
            1 => 'Đã xác nhận',
            2 => 'Đang giao',
            3 => 'Đã giao',
            4 => 'Đã hủy'
        ];

        $customerName = $bill->customer->CustomerName ?? $bill->customer->username ?? 'Khách hàng';
        $oldStatusText = $statusMessages[$oldStatus] ?? 'Không xác định';
        $newStatusText = $statusMessages[$newStatus] ?? 'Không xác định';

        AdminNotification::create([
            'type' => 'order_status_change',
            'title' => 'Thay đổi trạng thái đơn hàng',
            'message' => "Đơn hàng #{$bill->idBill} của khách hàng {$customerName} đã thay đổi từ '{$oldStatusText}' thành '{$newStatusText}'",
            'data' => [
                'bill_id' => $bill->idBill,
                'customer_id' => $bill->idCustomer,
                'customer_name' => $customerName,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'old_status_text' => $oldStatusText,
                'new_status_text' => $newStatusText,
                'url' => url("/list-bill")
            ],
            'admin_id' => null
        ]);

        return true;
    }

    /**
     * Get unread notifications for admin
     */
    public function getUnreadNotifications($adminId = null)
    {
        return AdminNotification::unread()
            ->forAdmin($adminId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get notification count for admin
     */
    public function getUnreadCount($adminId = null)
    {
        return AdminNotification::unread()
            ->forAdmin($adminId)
            ->count();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId)
    {
        $notification = AdminNotification::find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            return true;
        }
        return false;
    }

    /**
     * Mark all notifications as read for admin
     */
    public function markAllAsRead($adminId = null)
    {
        return AdminNotification::unread()
            ->forAdmin($adminId)
            ->update(['is_read' => true]);
    }
}

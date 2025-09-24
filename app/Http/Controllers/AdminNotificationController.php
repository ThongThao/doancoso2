<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminNotificationService;
use Illuminate\Support\Facades\Session;

class AdminNotificationController extends Controller
{
    protected $notificationService;

    public function __construct(AdminNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Get unread notifications count for admin
     */
    public function getUnreadCount(Request $request)
    {
        $adminId = Session::get('idAdmin');
        $count = $this->notificationService->getUnreadCount($adminId);
        
        return response()->json([
            'unread_count' => $count
        ]);
    }

    /**
     * Get notifications for admin
     */
    public function getNotifications(Request $request)
    {
        $adminId = Session::get('idAdmin');
        $notifications = $this->notificationService->getUnreadNotifications($adminId);
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $notifications->count()
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Request $request, $id)
    {
        $result = $this->notificationService->markAsRead($id);
        
        return response()->json([
            'success' => $result
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request)
    {
        $adminId = Session::get('idAdmin');
        $count = $this->notificationService->markAllAsRead($adminId);
        
        return response()->json([
            'success' => true,
            'marked_count' => $count
        ]);
    }
}

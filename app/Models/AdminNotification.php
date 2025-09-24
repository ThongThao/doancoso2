<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title', 
        'message',
        'data',
        'is_read',
        'admin_id'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean'
    ];

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope for specific admin or all admins
    public function scopeForAdmin($query, $adminId = null)
    {
        if ($adminId) {
            return $query->where(function($q) use ($adminId) {
                $q->where('admin_id', $adminId)->orWhereNull('admin_id');
            });
        }
        return $query->whereNull('admin_id');
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}

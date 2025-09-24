<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamp = false;
    protected $fillable = ['idCustomer','Address','Payment','Voucher','PhoneNumber','CustomerName','ReceiveDate','created_at','Status','TotalBill','OrderCode','TransactionId'];
    protected $primaryKey = 'idBill';
    protected $table = 'bill';
    
    protected $attributes = [
        'Status' => 0, // Mặc định là chờ xác nhận
    ];

    // Relationship with customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idCustomer', 'idCustomer');
    }
}

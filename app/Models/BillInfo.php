<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillInfo extends Model
{
    public $timestamp = false;
    protected $fillable = ['idBill','idProduct','AttributeProduct','Price','QuantityBuy','idProAttr'];
    protected $table = 'billinfo';
    public $incrementing = false;

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct', 'idProduct');
    }

    // Relationship with bill
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'idBill', 'idBill');
    }
}

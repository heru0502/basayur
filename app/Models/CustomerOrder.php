<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'status_order_id',
        'status_payment_id',
        'status_delivery_id',
        'subtotal',
        'discount_price',
        'discount_percentage',
        'grand_total',
        'voucher_id',
        'payment_id',
        'delivery_id',
        'customer_address_id',
        'note',
    ];

    public function items() {
        return $this->hasMany(CustomerOrderItem::class, 'order_id');
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function address() {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}

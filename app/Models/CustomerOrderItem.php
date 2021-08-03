<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'original_price',
        'discount',
        'selling_price',
        'qty',
        'total_price',
        'size_per_unit',
        'unit_id',
        'note',
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}

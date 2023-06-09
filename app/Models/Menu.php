<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_category_id',
        'name',
        'original_price',
        'discount',
        'selling_price',
        'is_active',
        'in_stock',
        'stock',
        'size_per_unit',
        'unit_id',
        'description',
        'image'
    ];

    public function category() {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}

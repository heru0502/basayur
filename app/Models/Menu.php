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
        'price',
        'special_price',
        'is_active',
        'in_stock',
        'stock',
        'size_per_unit',
        'unit_id',
        'description'
    ];
}

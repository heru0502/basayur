<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'village_id',
        'address',
    ];

    public function village() {
        return $this->belongsTo(Village::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}

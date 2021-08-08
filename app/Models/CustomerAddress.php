<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'village_id',
        'address',
        'phone_number',
        'location_point'
    ];

    public function village() {
        return $this->belongsTo(Village::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}

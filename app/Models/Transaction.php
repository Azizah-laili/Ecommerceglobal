<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id',
        'amount',
    ];

    public function transactions()
    {
        return $this->belongsTo(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}

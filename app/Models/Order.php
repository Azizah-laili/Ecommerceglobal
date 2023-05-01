<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'is_paid',
        'payment_receipt'
    ];

    //many to many product to order
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    //one to many user ro order
    public function user(){
        return $this->belongsTo(User::class);
    }
}

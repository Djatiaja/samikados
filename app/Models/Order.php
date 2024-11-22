<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function order_status(){
        return $this->belongsTo(Order_status::class);
    }

    public function order_detail(){
        return $this->hasMany(Order_detail::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}

<?php

namespace App\Models;

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
}

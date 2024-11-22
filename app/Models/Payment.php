<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    public function payment_method(){
        return $this->belongsTo(payment_method::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function payment_status(){
        return $this->belongsTo(payment_status::class);
    }

    public function payment_detail(){
        return $this->belongsTo(midtrans_status::class);
    }

    public function wallet(){
        return $this->has(Wallet::class);
    }
}

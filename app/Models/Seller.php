<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;

    public function User(){
        return $this->has(User::class);
    }

    public function city(){
        return $this->has(City::class);
    }

    public function Withdrawal(){
        return $this->hasMany(Withdrawal::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function wallet(){
        return $this->hasMany(Wallet::class);
    }
}

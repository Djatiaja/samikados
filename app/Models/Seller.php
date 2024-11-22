<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;

    public function User(){
        return $this->has(User::class);
    }

    public function Withdrawal(){
        return $this->hasMany(Withdrawal::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}

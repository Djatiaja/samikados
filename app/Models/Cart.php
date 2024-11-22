<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function cart_product_finishing(){
        return $this->has(Cart_product_finishing::class);
    }
}

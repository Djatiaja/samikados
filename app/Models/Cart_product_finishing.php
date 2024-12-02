<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_product_finishing extends Model
{
    /** @use HasFactory<\Database\Factories\CartProductFinishingFactory> */
    use HasFactory;

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function product_finishing(){
        return $this->belongsTo(Product_finishing::class);
    }
}

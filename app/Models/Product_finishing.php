<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_finishing extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFinishingFactory> */
    use HasFactory;

    public function finishing(){
        return $this->belongsTo(Product::class);
    }

    public function product(){
        return $this->belongsTo(Finishing::class);
    }

    public function order_detail(){
        return $this->hasMany(Order_detail::class);
    }
    public function cart_product_finishing(){
        return $this->hasMany(Cart_product_finishing::class);
    }
}

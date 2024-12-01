<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsToOne(Order::class);
    }

    public function product_finishing(){
        return $this->has(Product_finishing::class);
    }
}

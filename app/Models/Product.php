<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku',
        'thumbnail',
        'name',
        'description',
        'unit',
        'weight',
        'min_qty',
        'price',
        'buy_price',
        'is_publish',
        'brand_id',
        'category_id',
        'seller_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function product_finishing(){
        return $this->hasMany(Product_finishing::class);
    }

    public function order_detail(){
        return $this->hasMany(Order_detail::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_finishing extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFinishingFactory> */
    use HasFactory;

    public function finishing(){
        return $this->has(Product::class);
    }

    public function product(){
        return $this->has(Finishing::class);
    }
}

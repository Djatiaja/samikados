<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Finishing extends Model
{
    /** @use HasFactory<\Database\Factories\FinishingFactory> */
    use HasFactory;

    public function product_finishing(){
        return $this->HasMany(Product_finishing::class);
    }
}

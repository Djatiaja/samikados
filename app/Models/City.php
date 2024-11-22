<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;


    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function seller(){
        return $this->belongsToMany(Seller::class);
    }
}

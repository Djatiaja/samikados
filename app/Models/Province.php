<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->hasMany(City::class);
    }
}

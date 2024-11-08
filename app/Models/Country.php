<?php

namespace App\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code", 
        "flag"
    ];  
    
    protected $table = "countries";

    public function province(){
            return $this->hasMany(Province::class);
    }
}

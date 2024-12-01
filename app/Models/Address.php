<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $table ="addresses";

    public function user()  {
        $this->has(User::class);
    }

    public function city(){
        $this->has(City::class);
    }
}
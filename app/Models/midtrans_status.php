<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class midtrans_status extends Model
{
    /** @use HasFactory<\Database\Factories\MidtransStatusFactory> */
    use HasFactory;

    protected $table = "midtrans_status";

    public function payment(){
        return $this->hasMany(Payment::class);
    }
}

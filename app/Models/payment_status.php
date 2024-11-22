<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_status extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentStatusFactory> */
    use HasFactory;

    protected $table ="payment_status";

    public function payment(){
        return $this->hasMany(Payment::class);
    }
}

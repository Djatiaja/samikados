<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_status extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentStatusFactory> */
    use HasFactory;

    protected $table ="payment_status";
}

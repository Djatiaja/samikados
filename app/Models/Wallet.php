<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    /** @use HasFactory<\Database\Factories\WalletFactory> */
    use HasFactory;

    public function seller(){
        return $this->BelongsTo(Seller::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function status(){
        return $this->belongsTo(Request_status::class);
    }
}

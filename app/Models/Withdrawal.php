<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    /** @use HasFactory<\Database\Factories\WithdrawalFactory> */
    use HasFactory;

    protected $fillable = [
        "status",
        "jumlah",
        "rekening",
        "bank_id",
        "seller_id"
    ];

    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    public function Bank(){
        return $this->belongsTo(Bank::class);
    }
}

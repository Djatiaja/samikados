<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_status extends Model
{
    /** @use HasFactory<\Database\Factories\RequestStatusFactory> */
    use HasFactory;

    protected $table="request_status";

    public function wallet(){
        return $this->has(Wallet::class);
    }
}

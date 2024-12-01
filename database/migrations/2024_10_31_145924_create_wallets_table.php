<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();

            $table->integer('amount');
            $table->boolean('is_deposit');
            $table->timestamps();

            $table->foreignId('seller_id')->references('id')->on('sellers');
            $table->foreignId('payment_id')->references('id')->on('payments');
            $table->foreignId('status_id')->references('id')->on('request_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};

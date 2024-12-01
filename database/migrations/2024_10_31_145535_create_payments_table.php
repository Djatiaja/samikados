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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code');
            $table->integer('amount');
            $table->integer('aplication_fee');
            $table->integer('grand_amount');
            $table->timestamps();

            $table->foreignId('payment_method_id')->references("id")->on("payment_methods");
            $table->foreignId('order_id')->references("id")->on("orders");
            $table->foreignId('seller_id')->references("id")->on("sellers");
            $table->foreignId('payment_status_id')->references("id")->on("payment_status");
            $table->foreignId('payment_detail_id')->references("id")->on("midtrans_status");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->double( 'subtotal_weight');
            $table->integer('subtotal_price');
            $table->integer('subtotal_buy_price');
            $table->integer('quantity');
            $table->timestamps();


            $table->foreignId('product_id')->references("id")->on('products');
            $table->foreignId('order_id')-> references("id")->on('orders');
            $table->unsignedBigInteger('product_finishing_id')->nullable();
            $table->foreign('product_finishing_id')->references("id")->on("product_finishings"); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

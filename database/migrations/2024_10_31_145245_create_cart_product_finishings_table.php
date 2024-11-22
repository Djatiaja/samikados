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
        Schema::create('cart_product_finishings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('cart_id')->references("id")->on("carts"); // FK
            $table->foreignId('product_finishing_id')->references("id")->on("product_finishings"); // FK
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_product_finishings');
    }
};

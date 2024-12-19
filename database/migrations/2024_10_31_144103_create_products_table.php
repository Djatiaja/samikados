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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('thumbnail');
            $table->string('name');
            $table->text('description');
            $table->integer('unit');
            $table->integer('weight');
            $table->integer('min_qty');
            $table->integer('price');
            $table->integer('buy_price');
            $table->boolean('is_publish')->default(false); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('brand_id')->references("id")->on("brands");
            $table->foreignId('category_id')->references("id")->on("categories");
            $table->foreignId('seller_id')->references("id")->on("sellers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

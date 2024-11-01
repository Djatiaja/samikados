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
        Schema::create('product_finishings', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->timestamps();

            $table->foreignId('product_id')->references("id")->on("products"); // FK
            $table->foreignId('finishing_id')->references("id")->on("finishings"); // FK
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_finishings');
    }
};

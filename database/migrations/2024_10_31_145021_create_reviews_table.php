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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->integer('score');
            $table->string('image')->nullable(); // Optional: Allow null for no image
            $table->text('description');
            $table->timestamps();

            $table->foreignId('user_id')->references("id")->on("users"); // FK
            $table->foreignId('product_id')->references("id")->on("products"); // FK
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

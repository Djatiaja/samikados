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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string("address");
            $table->string("additional_info");
            $table->integer("subtotal");
            $table->string("delivery_type");
            $table->string("delivery_code");
            $table->string("tracking_code");
            $table->integer("delivery_price");
            $table->integer("grand_total");
            $table->timestamps();


            $table->foreignId("user_id")->references("id")->on("users");
            $table->foreignId("seller_id")->references("id")->on("sellers");
            $table->foreignId("order_status_id")->references("id")->on("order_status");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

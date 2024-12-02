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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string("no_rekening");
            $table->integer("jumlah");
            $table->enum("status", ["Menunggu", "Disetujui", "Ditolak"])->default("Menunggu");
            $table->timestamps();

            $table->foreignId("bank_id")->references("id")->on("banks");
            $table->foreignId("seller_id")->references("id")->on("sellers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};

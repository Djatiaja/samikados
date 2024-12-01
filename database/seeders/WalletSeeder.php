<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments= Payment::all();

        foreach ($payments as $payment) {
            Wallet::factory()->create([
                "seller_id" => $payment->seller_id,
                "payment_id" => $payment->id,
                "amount" => $payment->amount,
            ]);
        }
    }
}
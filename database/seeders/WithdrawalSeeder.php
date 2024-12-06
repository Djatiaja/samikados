<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Seller;
use App\Models\Withdrawal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $seller = Seller::all()->random();
            $seller = Seller::with("wallet")->find($seller->id);
            $amount = $seller->wallet->where("is_deposit", false)->sum("amount");

            $status = fake()->randomElement(["Menunggu", "Disetujui", "Ditolak"]);
            if ($status === "Disetujui") {
            $seller->wallet->each(function ($wallet) {
                $wallet->is_deposit = true;
                $wallet->save();
            });
            }
            if($amount<=0){
                break;
            }

            Withdrawal::factory()->create([
                "no_rekening" => fake()->numerify('###############'),
                "jumlah" => $amount,
                "status" => $status,
                "bank_id" => Bank::all()->random()->id,
                "seller_id" => $seller->id,
                "created_at" => fake()->dateTimeThisMonth(),
            ]);
        }

    }

}

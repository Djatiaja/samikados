<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class WithdrawalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seller = Seller::all()->random();
        $seller = Seller::with("wallet")->find($seller->id);
        $amount = $seller->wallet->where("is_deposit", false)->sum("amount");

        $status = fake()->randomElement(["Menunggu", "Disetujui", "Ditolak"]);
        if($status === "Disetujui"){
            $seller->wallet->each(function ($wallet) {
                $wallet->is_deposit = true;
                $wallet->save();
            });
        }
        
        return [
            "no_rekening"=>fake()->numerify('###############'),
            "jumlah"=>$amount,
            "status"=> $status,
            "bank_id"=>Bank::all()->random(),
            "seller_id"=>$seller->id,
            "created_at" => fake()->dateTimeThisMonth(),
        ];
    }
}

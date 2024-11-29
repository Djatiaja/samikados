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
        return [
            "no_rekening"=>fake()->numerify('###############'),
            "jumlah"=>fake()->numberBetween(100, 10000) * 1000,
            "status"=>fake()->randomElement(["Menunggu", "Disetujui", "Ditolak"]),
            "bank_id"=>Bank::all()->random(),
            "seller_id"=>Seller::all()->random()
        ];
    }
}

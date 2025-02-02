<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"=>User::all()->random(),
            "city_id"=>City::all()->random(),
            "name"=>fake()->name(),
            "address"=>fake()->address(),
            "description"=>fake()->text(150),
            "postal_code"=>fake()->numberBetween(1000,9999)
        ];
    }
}

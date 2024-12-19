<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->name(),
            "address"=> fake()->text(150),
            "postal_code"=>fake()->numberBetween(1000,9999),
            "latitude"=>fake()->latitude(),
            "longitude"=>fake()->longitude(),
            "phone"=>fake()->phoneNumber(),
            "is_default"=>false,
        ];
    }
}

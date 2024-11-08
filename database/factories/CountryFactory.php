<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    public static $flag = "public/flag/bendera_indonesia.png";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    public function definition(): array
    {
        return [
            "name"=>fake()->country(),
            "code"=>fake()->countryCode(),
            "flag"=> static::$flag,
        ];
    }
}

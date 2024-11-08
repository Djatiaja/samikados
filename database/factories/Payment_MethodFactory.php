<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Void_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\payment_method>
 */
class Payment_MethodFactory extends Factory
{
    public static $image ="public/payment_method/example.png";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->word(),
            "image"=> static::$image
        ];
    }
}

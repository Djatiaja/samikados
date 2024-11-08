<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    public static $image = "public/review/example.png";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"=>User::all()->random(),
            "product_id"=>Product::all()->random(),
            "score"=>fake()->numberBetween(1,5),
            "image"=>  static::$image,
            "description"=> fake()->paragraph()
        ];
    }
}

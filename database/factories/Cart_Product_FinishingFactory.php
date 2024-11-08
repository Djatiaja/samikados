<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Finishing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart_product_finishing>
 */
class Cart_Product_FinishingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "cart_id"=>Cart::all()->random(),
            "finishing_id"=>Finishing::all()->random(),
        ];
    }
}

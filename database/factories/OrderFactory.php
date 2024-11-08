<?php

namespace Database\Factories;

use App\Models\Order_status;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal= 0;
        $delivery_price= fake()->numberBetween(10, 100) * 1000;
        $total = 0 +$delivery_price;
        
        return [
            "user_id"=>User::all()->random(),
            "seller_id"=>Seller::all()->random(),
            "address"=>fake()->address(),
            "additional_info"=>fake()->sentence(20),
            "subtotal"=>$subtotal,
            "delivery_type"=>fake()->sentence(1),
            "delivery_code"=>Str::random(),
            "tracking_code"=>Str::random(),
            "delivery_price"=> $delivery_price,
            "grand_total"=> $total,
            "order_status_id"=>Order_status::all()->random()
        ];
    }
}

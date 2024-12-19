<?php

namespace Database\Factories;

use App\Models\Order_status;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
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
        $total = 0 +$delivery_price + 3000;
        
        return [
            "user_id"=>User::all()->random(),
            "seller_id"=>Seller::all()->random(),
            "address"=>fake()->address(),
            "additional_info"=>fake()->text(255),
            "subtotal"=>$subtotal,
            "delivery_type"=>fake()->text(255),
            "delivery_code"=>Str::random(),
            "tracking_code"=>Str::random(),
            "delivery_price"=> $delivery_price,
            "aplication_fee"=> 3000,
            "grand_total"=> $total,
            "order_status_id"=>Order_status::all()->random(),
            "created_at" => Carbon::now()->subDays(rand(0, 365)),  // Random date in the past year
            "updated_at" => Carbon::now(),
        ];
    }
}

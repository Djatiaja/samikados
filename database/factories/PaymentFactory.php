<?php

namespace Database\Factories;

use App\Models\midtrans_status;
use App\Models\Order;
use App\Models\payment_method;
use App\Models\payment_status;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Pest\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order=Order::all()->random();
        
        return [
            "payment_method_id"=>payment_method::all()->random(),
            "order_id"=>$order->id,
            "seller_id"=>$order->seller_id,
            "payment_status_id"=>payment_status::all()->random(),
            "payment_detail_id"=>midtrans_status::all()->random(),
            "payment_code"=>Str::random(),
            "amount"=>$order->grand_total ,
            "created_at"=> $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\Product_finishing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_detail>
 */
class Order_DetailFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::all()->random();
        $product = Product::all()->random();

        $finishing =fake()->randomElement([Product_finishing::where('product_id', 1)->inRandomOrder()->first(), null]);
        $quantity = fake()->numberBetween(1, 100);
        $weight = $product->weight * $quantity;
        $price = $product->price * $quantity + (isset($finishing)? $finishing->price:0);
        
        $order->subtotal+= $price;
        $order->grand_total+= $price;
        $order->save();


        return [
            "order_id" => $order->id,
            "product_id" => $product->id,
            "product_finishing_id" => isset($finishing) ? $finishing->id : null,
            'subtotal_weight' => $weight,
            'subtotal_price' => $price,
            'subtotal_buy_price' =>$price,
            'quantity' => $quantity,
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Cart_product_finishing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartProductFinishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = Cart::all();
        foreach ($carts as $cart) {
            Cart_product_finishing::factory()->create(["cart_id"=>$cart->id]);
        }
    }
}

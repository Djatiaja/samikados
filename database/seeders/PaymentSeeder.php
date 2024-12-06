<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            Payment::factory()->create([
                "order_id" => $order->id,
                "seller_id" => $order->seller_id,
                "amount" => $order->grand_total,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            Order_detail::factory()->count(10)->create(["order_id"=>$order->id]);
        }

    }
}

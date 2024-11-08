<?php

namespace Database\Seeders;

use App\Models\Order_status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order_status::factory()->count(3)->create();
    }
}

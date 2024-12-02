<?php

namespace Database\Seeders;

use App\Models\payment_status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        payment_status::factory()->count(3)->create();
    }
}

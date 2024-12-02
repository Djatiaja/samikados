<?php

namespace Database\Seeders;

use App\Models\payment_method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        payment_method::factory()->count(5)->create();
    }
}

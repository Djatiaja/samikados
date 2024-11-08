<?php

namespace Database\Seeders;

use App\Models\midtrans_status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MidtransStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        midtrans_status::factory()->count(3)->create();
    }
}

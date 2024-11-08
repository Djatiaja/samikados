<?php

namespace Database\Seeders;

use App\Models\Finishing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Finishing::factory()->count(20)->create();
    }
}

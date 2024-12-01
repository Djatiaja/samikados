<?php

namespace Database\Seeders;

use App\Models\Request_status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request_status::factory()->count(5)->create();
    }
}

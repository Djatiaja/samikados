<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Database\Factories\CityFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = Province::all();
        foreach ($provinces as $province ) {
            City::factory()->count(10)->create(["province_id"=>$province->id]);
        }
    }
}

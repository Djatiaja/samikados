<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Province;
use Database\Factories\ProvinceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::all();
        foreach ($countries as $country ) {
            Province::factory()->count(10)->create(["country_id"=>$country->id]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $min = City::min("id");
        $max = City::max("id");

        $users = User::all();

        // Menambahkan alamat pengguna yang sedang digunakan saat ini
        foreach ($users as $user) {
            Address::factory()->create([
                    "city_id"=>fake()->numberBetween($min, $max),
                    "user_id"=>$user->id,
                    "is_default"=>true
                ]);
        }

        // Menambahkan alamat cadangan pengguna
        foreach ($users as $user) {
            Address::factory()->count(2)->create([
                "city_id" => fake()->numberBetween($min, $max),
                "user_id" => $user->id
            ]);
        }
    }
}

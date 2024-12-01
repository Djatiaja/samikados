<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => fake()->name(),
            'username' => "admin",
            'email' => "djamgt23@gmail.com",
            'email_verified_at' => fake()->randomElement([now(), null]),
            'password' => "asdfasdf",
            'is_suspended' => false,
            "role_id" =>1,
            'remember_token' => Str::random(10),
        ]);
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random(), 
            'title' => $this->faker->sentence(), 
            'message' => $this->faker->paragraph(), 
            'type' => $this->faker->randomElement(['info', 'warning', 'error', 'success']),
            'is_read' => $this->faker->boolean(30),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author' => $this->faker->name(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['share', 'private']),
            'status' => $this->faker->randomElement(['approved', 'rejected', 'pending']),
            'user_id' => User::inRandomOrder()->first()->id,
            'rejection_reason' => $this->faker->sentence(),
        ];
    }
}

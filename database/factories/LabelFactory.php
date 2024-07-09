<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Label>
 */
class LabelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'label' => fake()->word(),
            'bg_color' => fake()->hexColor(),
            'font_color' => fake()->hexColor(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

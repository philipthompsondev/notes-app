<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
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
            'title' => fake()->word(),
            'message' => fake()->realText(),
            'bg_color' => fake()->hexColor(),
            'font_color' => fake()->hexColor(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

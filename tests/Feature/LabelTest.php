<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/labels');

        $response->assertStatus(200);
    }

    /**
     * @throws \JsonException
     */
    public function test_note_create(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/labels', [
                'label' => 'Test Label',
                'bg_color' => '#FFFFFF',
                'font_color' => '#000000',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/labels');
    }
}

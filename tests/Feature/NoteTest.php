<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_notes_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/notes');

        $response
            ->assertStatus(200)
            ->assertOk();
    }

    /**
     * @throws \JsonException
     */
    public function test_note_create(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/notes', [
                'title' => 'Test Title',
                'message' => 'Test Message',
                'bg_color' => '#FFFFFF',
                'font_color' => '#000000',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/notes');
    }
}

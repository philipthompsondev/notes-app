<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function testNoteIndex(): void
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
    public function testNoteStore(): void
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

        $note = Note::latest()->first();

        $this->assertSame('Test Title', $note->title);
        $this->assertSame('Test Message', $note->message);
        $this->assertSame('#FFFFFF', $note->bg_color);
        $this->assertSame('#000000', $note->font_color);
    }

    public function testNoteEdit()
    {
        $note = Note::factory()->create();
        $user = User::find($note->user_id);

        $response = $this
            ->actingAs($user)
            ->get('/notes/'.$note->id.'/edit', [
                $note
            ]);

        $response
            ->assertStatus(200)
            ->assertOk();
    }

    /**
     * @throws \JsonException
     */
    public function testNoteUpdate(): void
    {
        $note = Note::factory()->create();
        $user = User::find($note->user_id);

        $response = $this
            ->actingAs($user)
            ->patch('/notes/'.$note->id, [
                'title' => 'Test Title',
                'message' => 'Test Message',
                'bg_color' => '#FFFFFF',
                'font_color' => '#000000',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/notes');

        $editedNote = Note::latest()->first();

        $this->assertSame('Test Title', $editedNote->title);
        $this->assertSame('Test Message', $editedNote->message);
        $this->assertSame('#FFFFFF', $editedNote->bg_color);
        $this->assertSame('#000000', $editedNote->font_color);
    }

    /**
     * @throws \JsonException
     */
    public function testNoteDestroy()
    {
        $note = Note::factory()->create();
        $user = User::find($note->user_id);

        $response = $this
            ->actingAs($user)
            ->delete('/notes/'.$note->id, [
                $note
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/notes/');
    }
}

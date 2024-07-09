<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function testLabelIndex(): void
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
    public function testLabelStore(): void
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

        $label = Label::latest()->first();

        $this->assertSame('Test Label', $label->label);
        $this->assertSame('#FFFFFF', $label->bg_color);
        $this->assertSame('#000000', $label->font_color);
    }

    public function testLabelEdit()
    {
        $label = Label::factory()->create();
        $user = User::find($label->user_id);

        $response = $this
            ->actingAs($user)
            ->get('/labels/'.$label->id.'/edit', [
                $label
            ]);

        $response
            ->assertStatus(200)
            ->assertOk();
    }

    /**
     * @throws \JsonException
     */
    public function testLabelUpdate(): void
    {
        $label = Label::factory()->create();
        $user = User::find($label->user_id);

        $response = $this
            ->actingAs($user)
            ->patch('/labels/'.$label->id, [
                'label' => 'Edited Label',
                'bg_color' => '#FFFFFF',
                'font_color' => '#000000',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/labels');

        $editedLabel = Label::latest()->first();

        $this->assertSame('Edited Label', $editedLabel->label);
        $this->assertSame('#FFFFFF', $editedLabel->bg_color);
        $this->assertSame('#000000', $editedLabel->font_color);
    }

    /**
     * @throws \JsonException
     */
    public function testLabelDestroy()
    {
        $label = Label::factory()->create();
        $user = User::find($label->user_id);

        $response = $this
            ->actingAs($user)
            ->delete('/labels/'.$label->id, [
                $label
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/labels/');
    }
}

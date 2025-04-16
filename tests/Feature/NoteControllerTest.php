<?php

// tests/Feature/NoteControllerTest.php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_user_can_see_their_notes_index()
    {
        $this->actingAs($this->user);

        Note::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->get(route('note.index'));

        $response->assertOk();
        $response->assertViewIs('note.index');
    }

    public function test_user_can_view_create_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('note.create'));

        $response->assertOk();
        $response->assertViewIs('note.create');
    }

    public function test_user_can_store_note()
    {
        $this->actingAs($this->user);

        $data = ['note' => 'This is a test note'];

        $response = $this->post(route('note.store'), $data);

        $this->assertDatabaseHas('notes', ['note' => 'This is a test note']);
        $response->assertRedirect();
    }

    public function test_user_can_view_their_note()
    {
        $this->actingAs($this->user);

        $note = Note::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('note.show', $note));

        $response->assertOk();
        $response->assertViewIs('note.show');
    }

    public function test_user_can_edit_their_note()
    {
        $this->actingAs($this->user);

        $note = Note::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('note.edit', $note));

        $response->assertOk();
        $response->assertViewIs('note.edit');
    }

    public function test_user_can_update_their_note()
    {
        $this->actingAs($this->user);

        $note = Note::factory()->create(['user_id' => $this->user->id]);

        $response = $this->put(route('note.update', $note), ['note' => 'Updated note']);

        $response->assertRedirect(route('note.show', $note));
        $this->assertDatabaseHas('notes', ['id' => $note->id, 'note' => 'Updated note']);
    }

    public function test_user_can_delete_their_note()
    {
        $this->actingAs($this->user);

        $note = Note::factory()->create(['user_id' => $this->user->id]);

        $response = $this->delete(route('note.destroy', $note));

        $response->assertRedirect(route('note.index'));
        $this->assertModelMissing($note);
    }

    public function test_user_cannot_view_others_notes()
    {
        $this->actingAs($this->user);

        $otherUserNote = Note::factory()->create();

        $response = $this->get(route('note.show', $otherUserNote));

        $response->assertForbidden();
    }

    public function test_user_cannot_edit_others_notes()
    {
        $this->actingAs($this->user);

        $otherUserNote = Note::factory()->create();

        $response = $this->get(route('note.edit', $otherUserNote));

        $response->assertForbidden();
    }


    public function test_user_cannot_delete_others_notes()
    {
        $this->actingAs($this->user);

        $otherUserNote = Note::factory()->create();

        $response = $this->delete(route('note.destroy', $otherUserNote));

        $response->assertForbidden();
    }
}

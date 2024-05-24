<?php

namespace App\Listeners;

use App\Events\NoteCreated;
use App\Models\User;
use App\Notifications\NewNote;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNoteCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NoteCreated $event): void
    {
        foreach (User::whereNot('id', $event->note->user_id)->cursor() as $user) {
            $user->notify(new NewNote($event->note));
        }
    }
}

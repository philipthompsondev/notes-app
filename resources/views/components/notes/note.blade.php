<div class="rounded-lg px-2 py-2" style="background-color: {{ $note->bg_color }}; color: {{ $note->font_color }}">
    <div class="flex">
        <h3 class="w-5/6 font-bold">{{ $note->title }}</h3>
        <div class="w-1/6">
            <div class="float-end">
                @if ($note->user->is(auth()->user()))
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('notes.edit', $note)">
                                {{ __('Edit') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('notes.destroy', $note) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link :href="route('notes.destroy', $note)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>
        </div>
    </div>

    <p>{{ $note->message }}</p>

    {{-- TODO: Fix label delete on Note Index --}}
    <div class="flex flex-wrap gap-1">
        @foreach($note->labels as $label)
            <form method="POST" action="{{ route('labels.update', $note) }}">
                @csrf
                @method('patch')
                <x-notes.label
                    :label="$label->label"
                    :bgcolor="$label->bg_color"
                    :fontcolor="$label->font_color"
                    :href="route('labels.update', $note)"
                    onclick="
                        event.preventDefault();
                        this.closest('form').submit();
                    ">
                </x-notes.label>
            </form>
        @endforeach
    </div>
</div>

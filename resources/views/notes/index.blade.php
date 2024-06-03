<x-app-layout>
    <div class="grid grid-cols-5 gap-4 mx-10 my-5">
        <div class="col-span-2 row-span-2 bg-slate-200 rounded-lg px-2 py-2">
            <form method="POST" action="{{ route('notes.store') }}">
                @csrf
                <textarea
                    name="message"
                    placeholder="{{ __('Write something down.') }}"
                >{{ old('message') }}</textarea>

                <div>
                    @foreach($labels as $label)
                        <input type="checkbox" id="labels" name="labels[]" value="{{ $label["id"] }}"> <label
                            for="{{ $label["label"] }}">{{ $label["label"] }}</label>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('New Note') }}</x-primary-button>
            </form>
        </div>

        @foreach ($notes as $note)
            <div class="bg-amber-200 rounded-lg px-2 py-2">
                <div class="">
                    <div>
                        <span class="text-gray-800">{{ $note->user->name }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ $note->created_at->format('j M Y, g:i a') }}</small>
                    </div>
                    @if ($note->user->is(auth()->user()))
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
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

                <p>{{ $note->message }}</p>

                <div class="">
                    @foreach($note->labels as $label)
                        <div class="bg-slate-50 m-1 p-1">
                            {{ $label->label }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>

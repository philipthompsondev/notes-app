<x-app-layout>
    <div class="grid grid-cols-5 gap-4 mx-10 my-5">
        <div class="col-span-2 row-span-2 bg-slate-200 rounded-lg px-2 py-2">
            <form method="POST" action="{{ route('notes.store') }}">
                @csrf

                <input type="text" name="title" placeholder="Note Title">

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
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('New Note') }}</x-primary-button>
            </form>
        </div>

        @foreach ($notes as $note)
            <div class="bg-amber-200 rounded-lg px-2 py-2">
                <div class="">
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

                <h3>{{ $note->title }}</h3>
                <p>{{ $note->message }}</p>

                <div class="flex flex-wrap gap-1">
                    @foreach($note->labels as $label)
                        <form method="POST" action="{{ route('labels.destroy', $label) }}">
                            @csrf
                            @method('delete')
                            <x-notes.label
                                :label="$label->label"
                                :href="route('labels.destroy', $label)"
                                onclick="
                                    event.preventDefault();
                                    this.closest('form').submit();
                                ">
                            </x-notes.label>
                        </form>

                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>

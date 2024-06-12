<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('notes.update', $note) }}">
            @csrf
            @method('patch')

            <label for="title" hidden>Note Title</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ $note->title }}"
                class="w-full mb-2 p-2 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            <label for="message" hidden>Note Message</label>
            <textarea
                name="message"
                id="message"
                class="w-full h-full p-2 mb-2  border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{ old('message', $note->message) }}</textarea>

            <div class="w-full">
                <div>
                    <label for="bg_color">Background Color:</label>
                    <input name="bg_color" id="bg_color" type="color" value="{{ $note->bg_color }}">
                </div>

                <div>
                    <label for="font_color">Font Color:</label>
                    <input name="font_color" id="font_color" type="color" value="{{ $note->font_color }}">
                </div>
            </div>

            <div class="w-full my-6">
                @foreach($labels as $label)
                    <input type="checkbox" name="label_note[]" value="{{ $label->id }}" {{ in_array($label->id, $selected_labels) ? 'checked' : '' }}> <label for="labels">{{ $label->label }}</label>
                @endforeach
            </div>

            <div class="w-full">
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2 w-full">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('notes.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>

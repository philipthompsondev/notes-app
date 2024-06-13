<x-app-layout>
    <div class="grid grid-cols-5 gap-4 mx-10 my-5">
        <div class="col-span-2 row-span-2 bg-slate-200 rounded-lg px-2 py-2">
            <form method="POST" action="{{ route('notes.store') }}">
                @csrf

                <input type="text" name="title" placeholder="Note Title" class="w-full mb-2 p-2 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                <textarea
                    name="message"
                    placeholder="{{ __('Write something down.') }}"
                    class="w-full h-full p-2 mb-2  border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >{{ old('message') }}</textarea>

                <div class="grid grid-cols-2">
                    <div class="col-span-1">
                        <label for="bg_color">Background Color:</label>
                        <input name="bg_color" id="bg_color" type="color" value="#FFFFFF">
                    </div>

                    <div class="col-span-1">
                        <label for="font_color">Font Color:</label>
                        <input name="font_color" id="font_color" type="color" value="#000000">
                    </div>
                </div>

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
            <x-notes.note :note="$note"></x-notes.note>
        @endforeach
    </div>
</x-app-layout>

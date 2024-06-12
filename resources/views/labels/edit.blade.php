<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('labels.update', $label) }}">
            @csrf
            @method('patch')
            <label for="label">Label Title</label>
            <input type="text"
               name="label"
               id="label"
               value="{{ old('label', $label->label) }}"
               class="w-full mb-2 p-2 border border-slate-300 rounded-md shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            <div class="grid grid-cols-2">
                <div class="col-span-1">
                    <label for="bg_color">Background Color:</label>
                    <input name="bg_color" id="bg_color" type="color" value="{{ $label->bg_color }}">
                </div>

                <div class="col-span-1">
                    <label for="font_color">Font Color:</label>
                    <input name="font_color" id="font_color" type="color" value="{{ $label->font_color }}">
                </div>
            </div>

            <div class="w-full">
                <small>Created {{ $label->created_at }}</small>
            </div>

            <div class="w-full">
                <small>Updated {{ $label->updated_at }}</small>
            </div>

            <x-input-error :messages="$errors->get('label')" class="mt-2" />
            <x-input-error :messages="$errors->get('bg_color')" class="mt-2" />
            <x-input-error :messages="$errors->get('font_color')" class="mt-2" />

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('labels.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('labels.store') }}">
            @csrf

            <input type="text" name="label">
            <x-input-error :messages="$errors->get('label')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('New Label') }}</x-primary-button>
        </form>
    </div>

    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($labels as $label)
            <p class="mt-4 text-lg text-gray-900">{{ $label->label }}</p>
        @endforeach
    </div>
</x-app-layout>

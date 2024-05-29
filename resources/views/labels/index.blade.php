<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('labels.store') }}">
            @csrf

            <label>
                <input type="text" name="label">
            </label>
            <x-input-error :messages="$errors->get('label')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('New Label') }}</x-primary-button>
        </form>
    </div>

    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($labels as $label)
            <p class="mt-4 text-lg text-gray-900">{{ $label->label }} <small class="ml-2 text-sm text-gray-600">Created {{ $label->created_at }}</small></p>

            <x-dropdown>
                <x-slot name="trigger">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    {{-- TODO: Users can only edit their labels --}}

                    <x-dropdown-link :href="route('labels.edit', $label)">
                        {{ __('Edit') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('labels.destroy', $label) }}">
                        @csrf
                        @method('delete')
                        <x-dropdown-link :href="route('labels.destroy', $label)" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @endforeach





    </div>
</x-app-layout>

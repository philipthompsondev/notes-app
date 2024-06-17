
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('API Token') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Generate a token for accessing the api, the token will only be displayed once.") }}
        </p>
    </header>

    <form method="post" action="{{ route('api.token') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="token_name" :value="__('Token Name')" />
            <x-text-input id="token_name" name="token_name" type="text" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('token_name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    @foreach($user->tokens as $token)
        {{ $token->name }}
    @endforeach
</section>

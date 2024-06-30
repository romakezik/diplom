<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Токен для сброса пароля -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Адрес электронной почты -->
        <div>
            <x-input-label for="email" :value="__('Электронная почта')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Пароль -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Сбросить пароль') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

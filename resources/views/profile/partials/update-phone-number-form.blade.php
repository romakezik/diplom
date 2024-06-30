<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Обновить номер телефона') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Убедитесь, что ваш аккаунт использует актуальный номер телефона.') }}
        </p>
    </header>

    <form method="post" action="{{ route('phone_number.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_phone_number_current_phone_number" :value="__('Текущий номер телефона')" />
            <x-text-input id="update_phone_number_current_phone_number" name="current_phone_number" type="text" class="mt-1 block w-full" autocomplete="current-phone_number" value="{{ Auth::user()->phone_number }}" readonly />
            <x-input-error :messages="$errors->updatephone_number->get('current_phone_number')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_phone_number_phone_number" :value="__('Новый номер телефона')" />
            <x-text-input id="update_phone_number_phone_number" name="phone_number" type="text" class="mt-1 block w-full" autocomplete="new-phone_number" />
            <x-input-error :messages="$errors->updatephone_number->get('phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'phone-number-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </form>
</section>

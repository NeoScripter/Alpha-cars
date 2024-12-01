<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Забыли пароль? Не проблема. Просто сообщите нам ваш адрес электронной почты, и мы отправим вам ссылку для смены пароля.') }}
    </div>

    <!-- Session Status -->
    <x-admin.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-admin.input-label for="email" :value="__('Email')" />
            <x-admin.text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-admin.primary-button>
                {{ __('Отправить ссылку на email') }}
            </x-admin.primary-button>
        </div>
    </form>
</x-guest-layout>

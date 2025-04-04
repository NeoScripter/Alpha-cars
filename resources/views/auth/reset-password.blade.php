<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-admin.input-label for="email" :value="__('Email')" />
            <x-admin.text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-admin.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-admin.input-label for="password" :value="__('Пароль')" />
            <x-admin.text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-admin.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-admin.input-label for="password_confirmation" :value="__('Подтвердить пароль')" />

            <x-admin.text-input id="password_confirmation" class="block w-full mt-1"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-admin.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-admin.primary-button>
                {{ __('Поменять пароль') }}
            </x-admin.primary-button>
        </div>
    </form>
</x-guest-layout>

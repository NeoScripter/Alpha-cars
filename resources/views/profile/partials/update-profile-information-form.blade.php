<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Данные профиля
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Здесь вы можете обновить информацию профиля и адрес электронной почты вашего аккаунта.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-admin.input-label for="name" :value="__('Name')" />
            <x-admin.text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-admin.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-admin.input-label for="email" :value="__('Email')" />
            <x-admin.text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-admin.input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Нажмите здесь, чтобы повторно отправить письмо для подтверждения.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            Новая ссылка для подтверждения была отправлена на ваш адрес электронной почты.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-admin.primary-button>Сохранить</x-admin.primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Сохранено</p>
            @endif
        </div>
    </form>
</section>

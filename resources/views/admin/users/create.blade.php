<section>
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            Создать нового пользователя
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Введите необходимые данные для создания нового пользователя
        </p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
        @csrf

        <!-- User Name -->
        <x-form-field name="name" label="Имя пользователя" placeholder="Введите имя пользователя" />

        <!-- Email -->
        <x-form-field name="email" label="Электронная почта" placeholder="Введите email" />

        <!-- Password -->
        <x-form-field name="password" type="password" label="Пароль" placeholder="Введите пароль" />

        <!-- Confirm Password -->
        <x-form-field name="password_confirmation" type="password" label="Подтвердите пароль" placeholder="Введите пароль еще раз" />

        @if (Auth::user()->role === 'admin')
        <!-- Role -->
        <x-admin.select-field
            name="role"
            label="Роль"
            :options="[
                ['id' => 'user', 'name' => 'Пользователь'],
                ['id' => 'editor', 'name' => 'Редактор']
            ]"
            option-value="id"
            option-label="name"
            placeholder="Выберите роль"
        />
        @endif

        <!-- Image Upload -->
        <x-admin.image-upload
            label="Фото пользователя"
            alt-text="Фото пользователя"
            new-label="Новое фото"
            input-id="image"
            input-name="image"
        />

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <x-admin.primary-button>{{ __('Создать') }}</x-admin.primary-button>
        </div>
    </form>
</section>

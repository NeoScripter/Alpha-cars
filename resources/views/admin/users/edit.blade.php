<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Редактировать пользователя
        </h2>
    </x-slot>

    @if (isset($user))
        <section>
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data"
                class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <!-- Back Link -->
                <div class="flex items-center gap-4">
                    <x-admin.link href="{{ route('admin.users.index') }}">Назад</x-admin.link>
                </div>
                <hr>

                <!-- User Name -->
                <x-form-field name="name" label="Имя пользователя" :value="$user->name"
                    placeholder="Введите имя пользователя" />

                <!-- Email -->
                <x-form-field name="email" label="Электронная почта" :value="$user->email" placeholder="Введите email" />

                <!-- Password -->
                <x-form-field name="password" type="password" label="Пароль (оставьте пустым, если не хотите менять)"
                    placeholder="Введите новый пароль" />

                <!-- Confirm Password -->
                <x-form-field name="password_confirmation" type="password" label="Подтвердите пароль"
                    placeholder="Введите новый пароль еще раз" />



                @if (Auth::user()->role === 'admin')
                    <!-- Role -->
                    <x-admin.select-field name="role" label="Роль" :options="[['id' => 'user', 'name' => 'Пользователь'], ['id' => 'editor', 'name' => 'Редактор']]" option-value="id"
                        option-label="name" placeholder="Выберите роль" :value="$user->role" />
                @endif

                <!-- Image Upload -->
                <x-admin.image-upload label="Фото пользователя" :image-path="$user->image" alt-text="Фото пользователя"
                    new-label="Новое фото" input-id="image" input-name="image" />

                <hr>

                <!-- Save and Delete Buttons -->
                <div class="flex items-center gap-4">
                    <x-admin.primary-button>{{ __('Сохранить изменения') }}</x-admin.primary-button>

                    <x-admin.danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                        {{ __('Удалить пользователя') }}
                    </x-admin.danger-button>
                </div>
            </form>

        </section>

        <!-- Confirmation Modal for Deletion -->
        <x-admin.modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.users.destroy', $user->id) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    Вы уверены, что хотите удалить этого пользователя?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    В случае удаления пользователя, вся информация, связанная с ним будет безвозвратно
                    удалена.
                </p>

                <div class="flex justify-end mt-6">
                    <x-admin.secondary-button x-on:click="$dispatch('close')">
                        {{ __('Отмена') }}
                    </x-admin.secondary-button>

                    <x-admin.danger-button class="ms-3">
                        {{ __('Удалить') }}
                    </x-admin.danger-button>
                </div>
            </form>
        </x-admin.modal>
    @endif

</x-admin-layout>

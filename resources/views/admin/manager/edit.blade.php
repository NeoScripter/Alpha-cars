<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Редактировать менеджера
        </h2>
    </x-slot>

    @if (isset($manager))
        <section>
            <form method="POST" action="{{ route('admin.manager.update', $manager->id) }}" enctype="multipart/form-data"
                class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <!-- Back Link -->
                <div class="flex items-center gap-4">
                    <x-admin.link href="{{ route('admin.manager.index') }}">Назад</x-admin.link>
                </div>
                <hr>

                <!-- Manager Name -->
                <x-form-field name="name" label="Имя менеджера" :value="$manager->name" />

                <!-- Phone -->
                <x-form-field name="phone" label="Телефон" :value="$manager->phone" placeholder="Введите номер телефона" />

                <!-- Email -->
                <x-form-field name="email" label="Электронная почта" :value="$manager->email" placeholder="Введите email" />

                <!-- Supplier -->
                <x-admin.select-field
                    name="supplier_id"
                    label="Поставщик"
                    :options="$suppliers"
                    option-value="id"
                    option-label="name"
                    :placeholder="'Выберите поставщика'"
                    :value="$manager->supplier_id"
                />

                <!-- Image Upload -->
                <x-admin.image-upload label="Фото менеджера" :image-path="$manager->image" alt-text="Фото менеджера"
                    new-label="Новое фото" input-id="image" input-name="image" />

                <hr>

                <!-- Save and Delete Buttons -->
                <div class="flex items-center gap-4">
                    <x-admin.primary-button>{{ __('Сохранить изменения') }}</x-admin.primary-button>

                    <x-admin.danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-manager-deletion')">
                        {{ __('Удалить менеджера') }}
                    </x-admin.danger-button>
                </div>
            </form>

        </section>

        <!-- Confirmation Modal for Deletion -->
        <x-admin.modal name="confirm-manager-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.manager.destroy', $manager->id) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    Вы уверены, что хотите удалить этого менеджера?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    В случае удаления менеджера, вся информация, связанная с ним будет безвозвратно
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

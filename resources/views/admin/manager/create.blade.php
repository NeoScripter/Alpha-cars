<section>
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            Создать нового менеджера
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Введите необходимые данные для создания нового менеджера
        </p>
    </div>

    <form method="POST" action="{{ route('admin.manager.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
        @csrf

        <!-- Manager Name -->
        <x-form-field name="name" label="Имя менеджера" />

        <!-- Phone -->
        <x-form-field name="phone" label="Телефон" placeholder="Введите номер телефона" />

        <!-- Email -->
        <x-form-field name="email" label="Электронная почта" placeholder="Введите email" />

        <!-- Supplier -->
        <x-admin.select-field
            name="supplier_id"
            label="Поставщик"
            :options="$suppliers"
            option-value="id"
            option-label="name"
            placeholder="Выберите поставщика"
        />

        <!-- Image Upload -->
        <x-admin.image-upload
            label="Фото менеджера"
            alt-text="Фото менеджера"
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

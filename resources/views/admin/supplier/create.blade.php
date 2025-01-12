<section>
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            Создать нового поставщика
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Введите необходимые данные для создания нового поставщика
        </p>
    </div>

    <form method="POST" action="{{ route('supplier.create') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
        @csrf

        <!-- Supplier Name -->
        <x-form-field name="name" label="Название поставщика" />

        <!-- Emails -->
        <x-admin.array-field field-name="emails" label="Электронные адреса" singular-label="Email"
            placeholder="Введите email" :values="[]" />

        <!-- Phones -->
        <x-admin.array-field field-name="phones" label="Телефоны" singular-label="Телефон" placeholder="Введите номер"
            :values="[]" />

        <!-- Website -->
        <x-form-field name="website" label="Веб-сайт поставщика" />

        <!-- Platform Address -->
        <x-form-field name="platform_address" label="Адрес платформы" />

        <!-- Unload Address -->
        <x-form-field name="unload_address" label="Адрес разгрузки" />

        <!-- Legal Entity -->
        <x-form-field name="legal_entity" label="Юридическое лицо" />

        <!-- ITN -->
        <x-form-field name="itn" label="ИНН (Налоговый номер)" />

        <!-- RRC -->
        <x-form-field name="rrc" label="Регистрационный код" />

        <!-- Rating -->
        <x-admin.simple-select-field name="rating" label="Рейтинг" :options="$criteria->rating" />

        <!-- Car Type -->
        <x-admin.array-select field-name="carType" label="Типы автомобилей" singular-label="Тип"
         :values="[]" :options="$criteria->carTypes" />

        <!-- Car Subtype -->
        <x-admin.array-select field-name="carSubtype" label="Подтипы автомобилей" singular-label="Подтип"
         :values="[]" :options="$criteria->carSubtypes" />

        <!-- Car Make -->
        <x-admin.array-select field-name="carMake" label="Марки автомобилей" singular-label="Марку"
         :values="[]" :options="$criteria->carMakes" />


        <!-- Work Terms -->
        <x-admin.simple-select-field name="workTerms" label="Условия работы" :options="$criteria->workTerms" />

        <!-- Supervisor -->
        <x-form-field name="supervisor" label="Контактное лицо (руководитель)" />

        <!-- DKP -->
        <x-admin.checkbox name="dkp" label="ДКП согласовано" />

        <!-- Image Specs -->
        <x-admin.checkbox name="image_spec" label="Спецификация картинкой" />

        <!-- Signees -->
        <x-form-field name="signees" label="Подписанты" />

        <!-- Warranties -->
        <x-admin.checkbox name="warantees" label="Гарантии" />

        <!-- Payment Without PTC -->
        <x-admin.checkbox name="payWithoutPTC" label="Можем ли оплачивать без ПТС" />


        <!-- Image Upload -->
        <x-admin.image-upload label="Фото поставщика" alt-text="Фото поставщика" new-label="Новое фото" input-id="image"
            input-name="image" />

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <x-admin.primary-button>{{ __('Создать') }}</x-admin.primary-button>
        </div>
    </form>

</section>

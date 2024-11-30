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
        <x-form-field name="emails" label="Электронные адреса" :is-textarea="true" />

        <!-- Phones -->
        <x-form-field name="phones" label="Телефоны" :is-textarea="true" />

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
        <x-form-field name="rating" label="Рейтинг" />

        <!-- Car Types -->
        <x-form-field name="carType" label="Типы автомобилей" :is-textarea="true" />

        <!-- Car Subtypes -->
        <x-form-field name="carSubtype" label="Подтипы автомобилей" :is-textarea="true" />

        <!-- Car Makes -->
        <x-form-field name="carMake" label="Марки автомобилей" :is-textarea="true" />

        <!-- Work Terms -->
        <x-form-field name="workTerms" label="Условия работы" :is-textarea="true" />

        <!-- Supervisor -->
        <x-form-field name="supervisor" label="Контактное лицо (руководитель)" />

        <!-- DKP -->
        <x-form-field name="dkp" label="ДКП предоставляется?" type="checkbox" />

        <!-- Image Specs -->
        <x-form-field name="image_spec" label="Соответствует требованиям изображения?" type="checkbox" />

        <!-- Signees -->
        <x-form-field name="signees" label="Подписанты" :is-textarea="true" />

        <!-- Warranties -->
        <x-form-field name="warantees" label="Гарантии предоставлены?" type="checkbox" />

        <!-- Payment Without PTC -->
        <x-form-field name="payWithoutPTC" label="Оплата без ПТК?" type="checkbox" />

        <!-- Image Upload -->
        <div>
            <p class="block mb-1 text-sm font-medium text-gray-700">Фото поставщика</p>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Новое
                фото</label>
            <input
                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="image" name="image" type="file">
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <x-admin.primary-button>{{ __('Создать') }}</x-admin.primary-button>
        </div>
    </form>
</section>

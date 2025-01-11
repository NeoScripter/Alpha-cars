<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Редактировать поставщика
        </h2>
    </x-slot>

    @if (isset($supplier))
        <section>
            <form method="POST" action="{{ route('supplier.update', $supplier->id) }}" enctype="multipart/form-data"
                class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <!-- Back Link -->
                <div class="flex items-center gap-4">
                    <x-admin.link href="{{ route('admin') }}">Назад</x-admin.link>
                </div>
                <hr>

                <!-- Supplier Name -->
                <x-form-field name="name" label="Название поставщика" :value="$supplier->name" />

                <!-- Emails -->
                <x-admin.array-field field-name="emails" label="Emails" singular-label="Email"
                    placeholder="Введите email" :values="$supplier->emails ?? []" />

                <!-- Phones -->
                <x-admin.array-field field-name="phones" label="Телефоны" singular-label="Телефон"
                    placeholder="Введите номер" :values="$supplier->phones ?? []" />

                <!-- Website -->
                <x-form-field name="website" label="Веб-сайт поставщика" :value="$supplier->website" />

                <!-- Platform Address -->
                <x-form-field name="platform_address" label="Адрес платформы" :value="$supplier->platform_address" />

                <!-- Unload Address -->
                <x-form-field name="unload_address" label="Адрес разгрузки" :value="$supplier->unload_address" />

                <!-- Legal Entity -->
                <x-form-field name="legal_entity" label="Юридическое лицо" :value="$supplier->legal_entity" />

                <!-- ITN -->
                <x-form-field name="itn" label="ИНН (Налоговый номер)" :value="$supplier->itn" />

                <!-- RRC -->
                <x-form-field name="rrc" label="Регистрационный код" :value="$supplier->rrc" />

                <!-- Rating -->
                <x-form-field name="rating" label="Рейтинг" :value="$supplier->rating" />

                <!-- Car Type -->
                <x-admin.array-select field-name="carType" label="Типы автомобилей" singular-label="Тип"
                    placeholder="Введите тип автомобиля" :values="$supplier->carType ?? []" :options="$criteria->carTypes" />

                <!-- Car Subtype -->
                <x-admin.array-select field-name="carSubtype" label="Подтипы автомобилей" singular-label="Подтип"
                    placeholder="Введите подтип автомобиля" :values="$supplier->carSubtypes ?? []" :options="$criteria->carSubtype" />

                <!-- Car Make -->
                <x-admin.array-select field-name="carMake" label="Марки автомобилей" singular-label="Марка"
                    placeholder="Введите марку автомобиля" :values="$supplier->carMake ?? []" :options="$criteria->carMake" />

                <!-- Work Terms -->
                <x-form-field name="workTerms" label="Условия работы" :is-textarea="true" :value="$supplier->workTerms" />

                <!-- Supervisor -->
                <x-form-field name="supervisor" label="Контактное лицо (руководитель)" :value="$supplier->supervisor" />

                <!-- DKP -->
                <x-admin.checkbox name="dkp" label="DKP Status" :value="$supplier->dkp ?? false" />

                <!-- Image Spec -->
                <x-admin.checkbox name="image_spec" label="Image Specification Met" :value="$supplier->image_spec ?? false" />

                <!-- Provides Warranty -->
                <x-admin.checkbox name="warantees" label="Provides Warranty" :value="$supplier->warantees ?? false" />

                <!-- Pay Without PTC -->
                <x-admin.checkbox name="payWithoutPTC" label="Pay Without PTC" :value="$supplier->payWithoutPTC ?? false" />

                <!-- Signees -->
                <x-form-field name="signees" label="Подписанты" :value="$supplier->signees" />

                <!-- Image Upload -->
                <x-admin.image-upload label="Фото поставщика" :image-path="$supplier->image" alt-text="Фото поставщика"
                    new-label="Новое фото" input-id="image" input-name="image" />

                <hr>

                <!-- Save and Delete Buttons -->
                <div class="flex items-center gap-4">
                    <x-admin.primary-button>{{ __('Сохранить изменения') }}</x-admin.primary-button>

                    <x-admin.danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-supplier-deletion')">
                        {{ __('Удалить поставщика') }}
                    </x-admin.danger-button>
                </div>
            </form>

        </section>

        <!-- Confirmation Modal for Deletion -->
        <x-admin.modal name="confirm-supplier-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('supplier.destroy', $supplier) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    Вы уверены, что хотите удалить этого поставщика?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    В случае удаления поставщика, вся информация, связанная с ним будет безвозвратно
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

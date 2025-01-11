    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Редактировать критерии поиска
        </h2>
    </x-slot>

    @if (isset($criteria))
        <section>
            <form method="POST" action="{{ route('admin.criteria.update', $criteria->id) }}" class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <x-admin.array-field field-name="carTypes" label="Типы авто" singular-label="Тип авто"
                        placeholder="" :values="$criteria->carTypes ?? []" />
                </div>

                <div class="mb-6">
                    <x-admin.array-field field-name="carSubtypes" label="Подтипы авто" singular-label="Подтип авто"
                        placeholder="" :values="$criteria->carSubtypes ?? []" />
                </div>

                <div class="mb-6">
                    <x-admin.array-field field-name="carMakes" label="Марки авто" singular-label="Марка авто"
                        placeholder="" :values="$criteria->carMake ?? []" />
                </div>

                <div class="mb-6">
                    <x-admin.array-field field-name="workTerms" label="Условия сотрудничества" singular-label="Условие сотрудничества"
                        placeholder="" :values="$criteria->workTerms ?? []" />
                </div>

                <div class="mb-6">
                    <x-admin.array-field field-name="rating" label="Рейтинг" singular-label="Рейтинг"
                        placeholder="" :values="$criteria->rating ?? []" />
                </div>

                <hr>

                <!-- Save and Delete Buttons -->
                <div class="flex items-center gap-4">
                    <x-admin.primary-button>{{ __('Сохранить изменения') }}</x-admin.primary-button>

                </div>
            </form>

        </section>

        @if (session('status') === 'success')
            <div class="fixed flex items-center p-4 space-x-4 text-gray-500 -translate-x-1/2 bg-white divide-x divide-gray-200 rounded-lg shadow w-max left-1/2 rtl:divide-x-reverse top-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
                role="alert" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                <div class="text-base font-normal text-center text-gray-600">
                    {{ session('message') }}
                </div>
            </div>
        @endif
    @endif


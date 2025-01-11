<section x-data="selectInputHandler()">

    @isset($options)
        <form method="GET" action="{{ route('user.index') }}" class="md:p-6 p-4 lg:p-8 bg-[#FBFBFB] rounded-xl">
            <div class="grid gap-4 my-4 sm:grid-cols-2 lg:grid-cols-4">
                <x-dropdown name="carType" :options="$options['carTypes']">
                    Тип авто
                </x-dropdown>

                <div>
                    <label for="carSubtype" class="block mb-2 text-sm font-medium" :class="fields.carType.length === 0 ? 'text-gray-400' : 'text-gray-900'">
                        Подтип авто
                    </label>

                    <select
                        :disabled="fields.carType.length === 0"
                        id="carSubtype"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        :class="fields.carType.length === 0 ? 'cursor-not-allowed text-transparent' : ''"
                        @change="addToArray('carSubtype', $event.target.value)"
                    >
                        <option value="" disabled selected :class="fields.carType.length > 0 ? 'hidden' : ''"></option>
                        @foreach ($options['carSubtypes'] as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <x-dropdown name="carMake" :options="$options['carMakes']">
                    Марка
                </x-dropdown>
                <x-dropdown name="name" :options="$options['names']">
                    Поставщик
                </x-dropdown>
            </div>

            <div class="flex-wrap items-center justify-between my-4 sm:flex gap-x-4 md:gap-10">
                <x-checkbox name="rating" :options="$options['ratings']">
                    Рейтинг дилера
                </x-checkbox>
                <x-checkbox name="workTerms" :options="$options['workTerms']">
                    Условия работы
                </x-checkbox>

                <button
                    class="block w-full px-6 py-3 mt-6 font-bold text-white transition-colors border md:ml-auto md:w-auto bg-black-primary rounded-xl hover:bg-red-primary"
                    type="submit">Подобрать</button>
            </div>
        </form>
    @endisset

    <div class="p-4 mt-20 md:mt-10 lg:mt-20 sm:flex sm:gap-4 sm:flex-wrap sm:items-center md:p-6 lg:p-8">
        <span class="inline-flex items-center gap-4 mb-4 text-sm text-black sm:text-base md:w-auto sm:mb-0 sm:w-full">
            Показать на странице
                <div class="flex items-center gap-1">
                    <a href="{{ route('user.index', array_merge(request()->except('page'), ['perPage' => 20])) }}"
                       class="py-1 px-3 block border rounded-md border-gray-200 {{ $perPage == 20 ? 'bg-red-primary text-white' : '' }} rounded">
                        20
                    </a>
                    <a href="{{ route('user.index', array_merge(request()->except('page'), ['perPage' => 40])) }}"
                       class="py-1 px-3 block border rounded-md border-gray-200 {{ $perPage == 40 ? 'bg-red-primary text-white' : '' }} rounded">
                        40
                    </a>
                    <a href="{{ route('user.index', array_merge(request()->except('page'), ['perPage' => 60])) }}"
                       class="py-1 px-3 block border rounded-md border-gray-200 {{ $perPage == 60 ? 'bg-red-primary text-white' : '' }} rounded">
                        60
                    </a>
                </div>

        </span>

        <div class="mb-6 sm:mb-0">
            <template x-for="(field, fieldName) in fields" :key="fieldName">
                <template x-for="(value, index) in field" :key="index">
                    <span
                        class="inline-flex items-center px-2 py-1 mx-2 my-1 rounded-lg bg-extra-light-gray text-red-primary">
                        <span x-text="`${value}`"></span>
                        <button class="ml-2 text-red-500 remove-button"
                            @click="removeFromArray(fieldName, index)">
                            &times;
                        </button>
                    </span>
                </template>
            </template>
            <button x-show="isEmpty()"
                class="inline-flex items-center px-2 py-1 my-1 text-gray-400 rounded-lg bg-extra-light-gray"
                @click="emptyArrays()">
                Сбросить все
            </button>
        </div>

        <button
            class="block w-full px-6 py-3 font-bold text-white transition-colors border sm:ml-auto sm:w-auto bg-red-primary rounded-xl hover:bg-black-primary"
            type="button">
            Отправить запрос
        </button>
    </div>

</section>

<script>
    function selectInputHandler() {
        return {
            fields: {
                carType: [],
                carSubtype: [],
                carMake: [],
                name: [],
            },

            addToArray(field, value) {
                if (value && !this.fields[field].includes(value)) {
                    this.fields[field].push(value);
                }
            },

            removeFromArray(field, index) {
                this.fields[field].splice(index, 1);

                if (this.fields.carType.length === 0) {
                    this.fields.carSubtype.length = 0;
                }
            },

            emptyArrays() {
                for (let key in this.fields) {
                    this.fields[key].length = 0;
                }
            },

            isEmpty() {
                return Object.values(this.fields).some(field => field.length > 0);
            },
        };
    }
</script>

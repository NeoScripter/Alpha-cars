<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <h1 class="mb-6 text-2xl sm:mb-8 font-regular">Поиск поставщика</h1>

        <section x-data="selectInputHandler()">

            @isset($options)
                <form method="GET" action="{{ route('user.index') }}" class="md:p-6 p-4 lg:p-8 bg-[#FBFBFB] rounded-xl">
                    <div class="grid gap-4 my-4 sm:grid-cols-2 lg:grid-cols-4">
                        <x-dropdown name="carType" :options="$options['carTypes']">
                            Тип авто
                        </x-dropdown>
                        <x-dropdown name="carSubtype" :options="$options['carSubtypes']">
                            Подтип авто
                        </x-dropdown>
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
                <span class="block mb-4 font-bold text-black md:w-auto sm:mb-0 sm:w-full">Всего найдено:
                    {{ isset($suppliers) ? count($suppliers) : 0 }}</span>

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

        <section id="table">
            <x-user.table-head />

            @isset($suppliers)
                @foreach ($suppliers as $index => $supplier)
                    <div x-data="{ showCarInfo: false, showManagerInfo: false }">


                        <x-user.supplier-info :order="$index + 1" :type="$supplier->carType" :subtype="$supplier->carSubtype" :make="$supplier->carMake"
                            :name="$supplier->name" :rating="$supplier->rating" :terms="$supplier->workTerms" :supervisor="$supplier->supervisor"
                            :avatars="$supplier->managers->pluck('image')->toArray()" />



                        <div x-show="showManagerInfo" x-transition x-cloak
                            class="py-6 border-t border-gray-[#E4E0E0] text-sm md:text-base text-black space-y-2">
                            @isset($supplier->managers)
                                @foreach ($supplier->managers as $manager)
                                    <x-user.manager-info :rating="$manager->stars" :name="$manager->name" :phone="$manager->phone"
                                        :email="$manager->email" :image="$manager->image" />
                                @endforeach
                            @endisset
                        </div>

                        <x-user.car-info :types="$supplier->carType" :subtypes="$supplier->carSubtype" :makes="$supplier->carMake" />
                    </div>
                @endforeach
            @endisset
        </section>

        @isset($suppliers)
            {{ $suppliers->links() }}
        @endisset

    </main>

    <footer class="h-8 mt-5 md:mt-10 bg-red-primary"></footer>

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
                },

                emptyArrays() {
                    for (let key in this.fields) {
                        this.fields[key].length = 0;
                    }
                },

                isEmpty() {
                    return Object.values(this.fields).some(field => field.length > 0);
                }
            };
        }
    </script>

</x-user-layout>

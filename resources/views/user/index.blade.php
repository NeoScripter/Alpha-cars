<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <h1 class="mb-6 text-2xl sm:mb-8 font-regular">Поиск поставщика</h1>

        <section x-data="selectInputHandler()">

            <form action="" class="md:p-6 p-4 lg:p-8 bg-[#FBFBFB] rounded-xl">
                <div class="grid gap-4 my-4 sm:grid-cols-2 lg:grid-cols-4">
                    <x-dropdown name="type" :options="['US' => 'United States', 'CA' => 'Canada', 'FR' => 'France', 'DE' => 'Germany']">
                        Тип авто
                    </x-dropdown>
                    <x-dropdown name="subtype" :options="['US' => 'United States', 'CA' => 'Canada', 'FR' => 'France', 'DE' => 'Germany']">
                        Подтип авто
                    </x-dropdown>
                    <x-dropdown name="make" :options="['US' => 'United States', 'CA' => 'Canada', 'FR' => 'France', 'DE' => 'Germany']">
                        Марка
                    </x-dropdown>
                    <x-dropdown name="supplier" :options="['US' => 'United States', 'CA' => 'Canada', 'FR' => 'France', 'DE' => 'Germany']">
                        Поставщик
                    </x-dropdown>
                </div>

                <div class="flex-wrap items-center justify-between my-4 sm:flex gap-x-4 md:gap-10">
                    <x-checkbox name="rating" :options="['A' => 'A', 'B' => 'B', 'C' => 'C']">
                        Рейтинг дилера
                    </x-checkbox>
                    <x-checkbox name="workTerms" :options="['vkrug' => 'АВ - в круг', 'no' => 'АВ - нет']">
                        Условия работы
                    </x-checkbox>

                    <button
                        class="block w-full px-6 py-3 mt-6 font-bold text-white transition-colors border md:ml-auto md:w-auto bg-black-primary rounded-xl hover:bg-red-primary"
                        type="submit">Подобрать</button>
                </div>
            </form>


            <div class="p-4 mt-20 md:mt-10 lg:mt-20 sm:flex sm:gap-4 sm:flex-wrap sm:items-center md:p-6 lg:p-8">
                <span class="block mb-4 font-bold text-black md:w-auto sm:mb-0 sm:w-full">Всего найдено: 20</span>

                <div class="mb-6 sm:mb-0">
                    <template x-for="(field, fieldName) in fields" :key="fieldName">
                        <template x-for="(value, index) in field" :key="index">
                            <span
                                class="inline-flex items-center px-2 py-1 mx-2 my-1 rounded-lg bg-extra-light-gray text-red-primary">
                                <span x-text="`${fieldName}: ${value}`"></span>
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

        <section>
            <x-user.table-head />

            <div x-data="{ showCarInfo: false, showManagerInfo: false }">
                <div
                    class="grid gap-4 py-6 grid-cols-[repeat(auto-fit,minmax(0px,1fr))] border-t border-gray-[#E4E0E0] text-xs sm:text-sm md:text-base text-black">
                    {{-- Choice --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0]">
                        <div class="flex items-center me-4">
                            <input checked id="red-checkbox" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-red-primary focus:ring-red-primary dark:focus:ring-red-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="red-checkbox"
                                class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">1</label>
                        </div>
                    </div>
                    {{-- Type, Subtype, Make --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] flex flex-col md:flex-row flex-wrap gap-2">
                        <div>ГА</div>
                        <div class="hidden md:block">ГА</div>
                        <div class="hidden md:block">ГА</div>
                        <span class="block space-y-2 md:hidden">
                            <div>Тягач</div>
                            <div>Audi</div>
                        </span>
                    </div>
                    {{-- Subtype --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">
                        Тягач
                        <x-user.expand-btn>+18</x-user.expand-btn>
                    </div>
                    {{-- Make --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">
                        Audi
                        <x-user.expand-btn>+18</x-user.expand-btn>
                    </div>
                    {{-- Supplier --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden sm:block">Рольф</div>
                    {{-- Rating --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">А</div {{-- Rating, AB --}}>
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden sm:block"><span class="md:hidden">А /
                        </span>АВ</div>
                    {{-- Supplier, Rating, Supervisor, Managers --}}
                    <div class="sm:mx-1 py-1 md:pr-3 border-r border-gray-[#E4E0E0]">
                        <span class="sm:hidden">Поставщик / Рейтинг / </span>
                        <span class="lg:hidden">Куратор / </span>


                        <x-user.avatar-btn :images="[
                            asset('images/png/avatar.jpeg'),
                            asset('images/png/avatar.jpeg'),
                            asset('images/png/avatar.jpeg'),
                            asset('images/png/avatar.jpeg'),
                        ]" />

                    </div>
                    {{-- Supervisor --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden lg:block">Богатко Ольга</div>
                </div>


                <div x-show="showManagerInfo" x-transition x-cloak
                    class="py-6 border-t border-gray-[#E4E0E0] text-sm md:text-base text-black space-y-2">
                    <x-user.manager-info />

                    <x-user.manager-info />

                    <x-user.manager-info />
                </div>


                <x-user.car-info :types="['Тягач', 'Самосвал']" :subtypes="['Подтип 1', 'Подтип 2', 'Подтип 3']" :makes="['Марка 1', 'Марка 2', 'Марка 3']" />
            </div>
        </section>


        @isset($suppliers)
            @foreach ($suppliers as $supplier)
                <div>
                    <h2>{{ $supplier->name }}</h2>
                    <p>Car Type: {{ $supplier->carType }}</p>
                    <p>Rating: {{ $supplier->rating }}</p>
                    <p>Work Terms: {{ $supplier->workTerms }}</p>
                    <p>Supervisor: {{ $supplier->supervisor }}</p>

                    <p>Car Subtypes:
                        @foreach ($supplier->carSubtype as $subtype)
                            {{ $subtype }},
                        @endforeach
                    </p>

                    <p>Car Makes:
                        @foreach ($supplier->carMake as $make)
                            {{ $make }},
                        @endforeach
                    </p>
                </div>
            @endforeach

        @endisset
    </main>

    <footer class="h-8 mt-5 md:mt-10 bg-red-primary"></footer>

    <script>
        function selectInputHandler() {
            return {
                fields: {
                    type: [],
                    subtype: [],
                    make: [],
                    supplier: [],
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

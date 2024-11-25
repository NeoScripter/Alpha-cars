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
            <x-user.table-head/>

            <div>
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
                    <div class="sm:mx-1 py-1 border-r border-gray-[#E4E0E0]">
                        <span class="sm:hidden">Поставщик / Рейтинг / </span>
                        <span class="lg:hidden">Куратор / </span>
                        <button class="flex gap-2 p-1 mt-2 rounded-full md:p-2 bg-extra-light-gray">
                            <div
                                class="grid grid-cols-[repeat(3,12px)] sm:grid-cols-[repeat(3,18px)] lg:grid-cols-[repeat(5,20px)]">
                                <x-user.avatar :img_path="asset('images/png/avatar.jpeg')" />
                                <x-user.avatar :img_path="asset('images/png/avatar.jpeg')" />
                                <div class="w-6 h-6 p-1 bg-gray-200 rounded-full sm:w-8 sm:h-8">
                                    +5
                                </div>
                            </div>
                            <div class="grid content-center p-2 pr-2">
                                <svg class="w-2 h-1 rotate-180 sm:w-3 sm:h-2 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    {{-- Supervisor --}}
                    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden lg:block">Богатко Ольга</div>
                </div>
                <div class="py-6 border-t border-gray-[#E4E0E0] text-sm md:text-base text-black space-y-2">
                    <div class="bg-[#FBFBFB] p-4 rounded-lg mx-auto sm:w-5/6 md:px-6 md:py-3 max-w-[1300px]">
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-gray-400">менеджер</div>
                            <div class="flex items-center gap-2">
                                4.6
                                <img src="{{ asset('images/svgs/star.svg') }}" alt="Желтая звезда" class="w-6 h-6">
                            </div>
                        </div>
                        <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('images/png/avatar.jpeg') }}" alt="Фото менеджера"
                                    class="w-8 h-8 rounded-full md:w-10 md:h-10">
                                Кузьмина Анна
                            </div>
                            <div>
                                <a href="tel:+7 (926) 123-45-23" class="block mb-4 text-blue-600">+7 (926) 123-45-23</a>
                                <a href="mailto:admin@rolf.ru" class="block underline">admin@rolf.ru</a>
                            </div>
                            <div class="self-end mt-6 sm:mt-0">
                                <button
                                    class="block px-6 py-3 mb-2 font-bold text-white transition-colors border bg-black-primary rounded-xl hover:bg-red-primary"
                                    type="submit">Оставить отзыв
                                </button>
                                <a href="" class="block ml-auto text-center text-gray-400 underline">Читать все отзывы</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 border-t border-gray-[#E4E0E0] text-xs sm:text-sm md:text-base text-black">
                    <div class="bg-[#FBFBFB] p-4 rounded-lg space-y-6 mx-auto sm:w-5/6 max-w-[906px] md:ml-[122px]">
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Тип
                            </div>
                            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                            </ul>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Подтип
                            </div>
                            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                            </ul>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Марка
                            </div>
                            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                                <li>Тягач</li>
                            </ul>
                        </div>
                    </div>
                </div>
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

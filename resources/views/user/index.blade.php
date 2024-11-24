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

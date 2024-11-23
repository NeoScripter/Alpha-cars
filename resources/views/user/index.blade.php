<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <h1 class="mb-6 text-2xl sm:mb-8 font-regular">Поиск поставщика</h1>

        <section x-data="selectInputHandler()"
            class="md:p-6 p-4 lg:p-8 bg-[#FBFBFB] rounded-xl space-y-4"
            >

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
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

            <div class="flex-wrap items-center justify-between sm:flex gap-x-4 md:gap-10">
                <x-checkbox name="rating" :options="['A' => 'A', 'B' => 'B', 'C' => 'C']">
                    Рейтинг дилера
                </x-checkbox>
                <x-checkbox name="workTerms" :options="['vkrug' => 'АВ - в круг', 'no' => 'АВ - нет']">
                    Условия работы
                </x-checkbox>

                <button class="block w-full px-6 py-3 mt-6 font-bold text-white transition-colors border md:ml-auto md:w-auto bg-black-primary rounded-xl hover:bg-red-primary" type="submit">Подобрать</button>
            </div>


            <div>
                <strong>Selected Parameters:</strong>
                <template x-for="(field, fieldName) in fields" :key="fieldName">
                    <template x-for="(value, index) in field" :key="index">
                        <span class="inline-flex items-center px-2 py-1 mx-2 mb-2 rounded-lg bg-extra-light-gray text-red-primary">
                            <span x-text="`${fieldName}: ${value}`"></span>
                            <button
                                class="ml-2 text-red-500 remove-button"
                                @click="removeFromArray(fieldName, index)"
                            >
                                ×
                            </button>
                        </span>
                    </template>
                </template>
            </div>

        </section>


    </main>

    <script>
        function selectInputHandler() {
            return {
                // Fields to store selected values
                fields: {
                    type: [],
                    subtype: [],
                    make: [],
                    supplier: [],
                },

                // Add a value to a specific field array
                addToArray(field, value) {
                    if (value && !this.fields[field].includes(value)) {
                        this.fields[field].push(value);
                    }
                },

                // Remove a value from a specific field array
                removeFromArray(field, index) {
                    this.fields[field].splice(index, 1);
                },
            };
        }
    </script>

</x-user-layout>

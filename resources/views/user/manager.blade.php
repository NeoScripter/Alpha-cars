<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1 mb-5 text-gray-400">
            <img src="{{ asset('images/svgs/back-to-main.svg') }}" alt="к списку" class="w-4 h-3">
            Назад
        </a>

        @isset($manager)

            <section x-data="{ perPage: 12, showPopup: {{ session('errors') ? 'true' : 'false' }} }" x-cloak class="p-4 mb-20 md:p-15">
                <div class="flex flex-wrap justify-between items-center gap-4 pb-4 mb-4 border-b border-gray-[#E4E0E0]">
                    <div class="inline-flex items-center gap-3 text-2xl">
                        <img src="{{ asset('images/svgs/manager-review.svg') }}" alt="Люди" aria-hidden
                            class="flex-shrink-0 w-8 h-8">
                        Отзывы о {{ $manager->name }}
                    </div>

                    <button
                        @click="showPopup = true"
                        class="block w-full px-6 py-3 font-bold text-white transition-colors border sm:w-auto bg-black-primary rounded-xl hover:bg-red-primary"
                        type="button">Оставить отзыв</button>
                </div>

                <div class="grid gap-4 grid-cols-auto-fit-250 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @php
                        $iterations = 0;
                    @endphp
                    @foreach ($manager->managerReviews as $index => $review)
                        @php
                            $iterations++;
                        @endphp
                        <x-user.manager-review :review="$review" :manager="$manager" :index="$index" />
                    @endforeach
                </div>

                <button x-show="{{ $iterations }} > perPage" @click="perPage += 12"
                    class="block w-full px-6 py-3 mx-auto mt-4 text-black transition-colors bg-white border border-black md:mt-6 hover:text-white md:w-auto rounded-xl hover:bg-black-primary"
                    type="button">Показать больше отзывов
                </button>
            </section>
        @endisset



    </main>

</x-user-layout>

<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <a href="{{ route('user.index') }}" class="inline-flex items-center gap-1 mb-5 text-gray-400">
            <img src="{{ asset('images/svgs/back-to-main.svg') }}" alt="к списку" class="w-4 h-3">
            К списку
        </a>

        @isset($supplier)
            <section class="bg-[#FBFBFB] rounded-xl p-4 md:p-10 mb-20">
                <div class="flex items-center gap-8 mb-4">
                    <h1 class="text-2xl font-bold md:text-3xl">{{ $supplier->name }}</h1>
                    <div class="inline-flex rounded-xl items-center gap-2 py-1 pl-4 pr-2 bg-[rgba(255,192,29,0.1)]">
                        <span class="block font-bold">{{ $supplier->stars }}</span>
                        <img src="{{ asset('images/svgs/star.svg') }}" alt="Желтая звезда" aria-hidden class="w-6 h-6">
                    </div>
                </div>

                <div class="flex flex-col flex-wrap gap-4 lg:flex-nowrap md:gap-10 md:flex-row">

                    @include('user.partials.supplier-info-top')

                    <div class="hidden ml-auto overflow-hidden md:block rounded-xl md:basis-[47%] lg:basis-1/4 lg:order-2">
                        <img src="{{ $supplier->image }}" alt="Фотография компании поставщика" class="rounded-xl">
                    </div>

                    <div class="flex flex-col gap-4 sm:flex-row sm:w-full lg:basis-1/2">

                        @include('user.partials.supplier-info-left')

                        @include('user.partials.supplier-info-right')
                    </div>

                    <div class="overflow-hidden md:hidden rounded-xl sm:h-63">
                        <img src="{{ $supplier->image }}" alt="Фотография компании поставщика">
                    </div>
                </div>

                <button
                    class="block w-full px-6 py-3 mt-8 font-bold text-white transition-colors border sm:mr-auto sm:w-auto bg-red-primary rounded-xl hover:bg-black-primary"
                    type="button">
                    Отправить запрос
                </button>
            </section>

            <section x-data="{ perPage: 12 }" x-cloak class="p-4 mb-20 md:p-10">
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 mb-4 border-b border-gray-[#E4E0E0]">
                    <div class="inline-flex items-center gap-3 text-2xl">
                        <img src="{{ asset('images/svgs/supplier-review.svg') }}" alt="Машина" aria-hidden
                            class="flex-shrink-0 w-8 h-8">
                        Отзывы о поставщике
                    </div>

                    <button
                        class="block w-full px-6 py-3 font-bold text-white transition-colors border sm:w-auto bg-black-primary rounded-xl hover:bg-red-primary"
                        type="button">Оставить отзыв</button>
                </div>

                <div class="grid gap-4 grid-cols-auto-fit-250 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @php
                        $iterations = 0;
                    @endphp
                    @foreach ($supplier->supplierReviews as $index => $review)
                        <x-user.supplier-review :review="$review" :index="$index" />
                        @php
                            $iterations++;
                        @endphp
                    @endforeach
                </div>

                <button x-show="{{ $iterations }} > perPage" @click="perPage += 12"
                    class="block w-full px-6 py-3 mx-auto mt-4 text-black transition-colors bg-white border border-black md:mt-6 hover:text-white md:w-auto rounded-xl hover:bg-black-primary"
                    type="button">Показать больше отзывов
                </button>
            </section>

            <section x-data="{ perPage: 12 }" x-cloak class="p-4 mb-20 md:p-15">
                <div class="flex flex-wrap items-center gap-4 pb-4 mb-4 border-b border-gray-[#E4E0E0]">
                    <div class="inline-flex items-center gap-3 text-2xl">
                        <img src="{{ asset('images/svgs/manager-review.svg') }}" alt="Машина" aria-hidden
                            class="flex-shrink-0 w-8 h-8">
                        Отзывы о менеджерах
                    </div>
                </div>

                <div class="grid gap-4 grid-cols-auto-fit-250 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @php
                        $iterations = 0;
                    @endphp
                    @foreach ($supplier->managers as $manager)
                        @foreach ($manager->managerReviews as $review)
                            <x-user.manager-review :review="$review" :manager="$manager" :index="$iterations" />
                            @php
                                $iterations++;
                            @endphp
                        @endforeach
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

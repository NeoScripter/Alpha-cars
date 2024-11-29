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

            <section class="p-4 mb-20 md:p-10">
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 mb-4 border-b border-gray-[#E4E0E0]">
                    <div class="inline-flex items-center gap-3 text-2xl">
                        <img src="{{ asset('images/svgs/supplier-review.svg') }}" alt="Машина" aria-hidden class="flex-shrink-0 w-8 h-8">
                        Отзывы о поставщике
                    </div>

                    <button class="block w-full px-6 py-3 font-bold text-white transition-colors border sm:w-auto bg-black-primary rounded-xl hover:bg-red-primary" type="button">Оставить отзыв</button>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($supplier->supplierReviews->take(8) as $review)
                        <div class="bg-[#F5F5F5] rounded-xl p-6 flex flex-col gap-6 justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold">{{ $review->stars }}</span>
                                <img src="{{ asset('images/svgs/yellow-star.svg') }}" alt="">
                            </div>

                            <div class="flex-1">
                                {{ $review->content }}
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 overflow-hidden rounded-full">
                                    <img src="{{ $review->user->image }}" alt="Пользователь" class="object-cover object-center w-full h-full">
                                </div>
                                {{ $review->user->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="p-4 mb-20 md:p-15">
                <div class="flex flex-wrap items-center gap-4 pb-4 mb-4 border-b border-gray-[#E4E0E0]">
                    <div class="inline-flex items-center gap-3 text-2xl">
                        <img src="{{ asset('images/svgs/manager-review.svg') }}" alt="Машина" aria-hidden class="flex-shrink-0 w-8 h-8">
                        Отзывы о менеджерах
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($supplier->supplierReviews->take(8) as $review)
                        <div class="bg-[#F5F5F5] rounded-xl p-6 flex flex-col gap-6 justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold">{{ $review->stars }}</span>
                                <img src="{{ asset('images/svgs/yellow-star.svg') }}" alt="">
                            </div>

                            <div class="flex-1">
                                {{ $review->content }}
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 overflow-hidden rounded-full">
                                    <img src="{{ $review->user->image }}" alt="Пользователь" class="object-cover object-center w-full h-full">
                                </div>
                                {{ $review->user->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endisset


            <!-- Manager Reviews -->
            <section>
                <h2>Manager Reviews</h2>
                @foreach ($supplier->managers as $manager)
                    <div>
                        <h3>Manager: {{ $manager->name }}</h3>
                        <img src="{{ $manager->image }}" alt="Manager image">
                        <ul>
                            @foreach ($manager->managerReviews->take(2) as $review)
                                <li>
                                    <strong>Reviewer:</strong> {{ $review->user->name }}
                                    <img src="{{ $review->user->image }}" alt="User image">
                                    <p><strong>Overall Stars:</strong> {{ $review->overallStars }}</p>
                                    <p><strong>Response Speed:</strong> {{ $review->responseSpeedStars }}</p>
                                    <p><strong>Price:</strong> {{ $review->priceStars }}</p>
                                    <p><strong>Keeps Word:</strong> {{ $review->keepsWordStars }}</p>
                                    <p><strong>Review:</strong> {{ $review->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </section>

    </main>

</x-user-layout>

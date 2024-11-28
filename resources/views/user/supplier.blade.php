<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <a href="{{ route('user.index') }}" class="inline-flex items-center gap-1 mb-5 text-gray-400">
            <img src="{{ asset('images/svgs/back-to-main.svg') }}" alt="к списку" class="w-4 h-3">
            К списку
        </a>

        @isset($supplier)
            <section class="bg-[#FBFBFB] rounded-xl p-4 md:p-10">
                <div class="flex items-center gap-8 mb-4">
                    <h1 class="text-2xl font-bold md:text-3xl">{{ $supplier->name }}</h1>
                    <div class="inline-flex rounded-xl items-center gap-2 py-1 pl-4 pr-2 bg-[rgba(255,192,29,0.1)]">
                        <span class="block font-bold">{{ $supplier->stars }}</span>
                        <img src="{{ asset('images/svgs/star.svg') }}" alt="Желтая звезда" aria-hidden class="w-6 h-6">
                    </div>
                </div>

                <div class="flex flex-col flex-wrap gap-4 md:gap-10 md:flex-row">

                    <div>
                        <div class="border-b border-gray-[#E4E0E0] flex items-start gap-3 p-4">
                            <img src="{{ asset('images/svgs/supplier-email.svg') }}" alt="email" class="pt-1">
                            <ul class="space-y-2">
                                @foreach ($supplier->emails as $email)
                                    <li class="block">{{ $email }}</li>
                                    <li class="block">{{ $email }}</li>
                                    <li class="block">{{ $email }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border-b border-gray-[#E4E0E0] flex items-start gap-3 p-4">
                            <img src="{{ asset('images/svgs/supplier-website.svg') }}" alt="phone" class="pt-1">
                            <a class="block underline" href="{{ $supplier->website }}">{{ $supplier->website }}</a>
                        </div>
                        <div class="border-b border-gray-[#E4E0E0] flex items-start gap-3 p-4">
                            <img src="{{ asset('images/svgs/supplier-call.svg') }}" alt="website" class="pt-1">
                            <ul class="space-y-2">
                                @foreach ($supplier->phones as $phone)
                                    <li class="block">{{ $phone }}</li>
                                    <li class="block">{{ $phone }}</li>
                                    <li class="block">{{ $phone }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border-b border-gray-[#E4E0E0] p-4">
                            <p class="mb-2 text-gray-400">адрес площадки</p>
                            <div class="flex items-start gap-3">
                                <img src="{{ asset('images/svgs/supplier-address.svg') }}" alt="location" class="pt-1">
                                <div>
                                    {{ $supplier->platform_address }}
                                </div>
                            </div>
                        </div>
                        <div class="border-b border-gray-[#E4E0E0] p-4">
                            <p class="mb-2 text-gray-400">адрес отгрузки</p>
                            <div class="flex items-start gap-3">
                                <img src="{{ asset('images/svgs/supplier-address.svg') }}" alt="location" class="pt-1">
                                <div>
                                    {{ $supplier->unload_address }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="space-y-4">
                            <div class="bg-[#F5F5F5] rounded-xl p-6">
                                <p class="mb-1 text-gray-400">юридическое лицо</p>
                                <div class="mb-4">{{ $supplier->legal_entity }}</div>
                                <p class="mb-1 text-gray-400">ИНН</p>
                                <div class="mb-4">{{ $supplier->itn }}</div>
                                <p class="mb-1 text-gray-400">КПП</p>
                                <div class="mb-4">{{ $supplier->rrc }}</div>
                            </div>

                            <div class="bg-[#F5F5F5] rounded-xl p-6">
                                <div class="flex items-start">
                                    <div class="flex-1">
                                        <p class="mb-1 text-gray-400">рейтинг</p>
                                        <div class="mb-4">{{ $supplier->rating }}</div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="mb-1 text-gray-400">тип техники</p>
                                        <ul class="mb-4">
                                            @foreach ($supplier->carType as $type)
                                                <li>{{ $type }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <p class="mb-1 text-gray-400">марки</p>
                                <div class="mb-4">{{ implode(', ', $supplier->carMake) }}</div>
                            </div>

                        </div>

                        <div class="bg-[#F5F5F5] rounded-xl p-6">
                            <p class="mb-1 text-gray-400">юридическое лицо</p>
                            <div class="mb-4">{{ $supplier->legal_entity }}</div>
                            <p class="mb-1 text-gray-400">ИНН</p>
                            <div class="mb-4">{{ $supplier->itn }}</div>
                            <p class="mb-1 text-gray-400">КПП</p>
                            <div class="mb-4">{{ $supplier->rrc }}</div>
                        </div>
                    </div>

                    <div class="md:hidden">
                        <img src="{{ $supplier->image }}" alt="Фотография компании поставщика">
                    </div>
                </div>

                <button
                    class="block w-full px-6 py-3 mt-8 font-bold text-white transition-colors border sm:mr-auto sm:w-auto bg-red-primary rounded-xl hover:bg-black-primary"
                    type="button">
                    Отправить запрос
                </button>
            </section>
        @endisset


        @isset($supplier)
            <ul>
                <li><img src="{{ $supplier->image }}" alt=""></li>
                <li>{{ $supplier->name }}</li>
                <li>{{ $supplier->stars }}</li>
                <li>{{ $supplier->website }}</li>
                <li>{{ $supplier->platform_address }}</li>
                <li>{{ $supplier->unload_address }}</li>
                <li>{{ $supplier->legal_entity }}</li>
                <li>{{ $supplier->itn }}</li>
                <li>{{ $supplier->rrc }}</li>
                <li>{{ $supplier->rating }}</li>
                <li>{{ $supplier->workTerms }}</li>
                <li>{{ $supplier->supervisor }}</li>
                <li>{{ $supplier->dkp }}</li>
                <li>{{ $supplier->image_spec }}</li>
                <li>{{ $supplier->signees }}</li>
                <li>{{ $supplier->warantees }}</li>
                <li>{{ $supplier->payWithoutPTC }}</li>

                @foreach ($supplier->emails as $email)
                    <li>{{ $email }}</li>
                @endforeach

                @foreach ($supplier->phones as $phone)
                    <li>{{ $phone }}</li>
                @endforeach

                @foreach ($supplier->carType as $type)
                    <li>{{ $type }}</li>
                @endforeach

                @foreach ($supplier->carSubtype as $subtype)
                    <li>{{ $subtype }}</li>
                @endforeach

                @foreach ($supplier->carMake as $make)
                    <li>{{ $make }}</li>
                @endforeach
            </ul>

            <!-- Supplier Reviews -->
            <section>
                <h2>Supplier Reviews</h2>
                <ul>
                    @foreach ($supplier->supplierReviews as $review)
                        <li>
                            <strong>Reviewer:</strong> {{ $review->user->name }}
                            <img src="{{ $review->user->image }}" alt="User image">
                            <p><strong>Stars:</strong> {{ $review->stars }}</p>
                            <p><strong>Review:</strong> {{ $review->content }}</p>
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Manager Reviews -->
            <section>
                <h2>Manager Reviews</h2>
                @foreach ($supplier->managers as $manager)
                    <div>
                        <h3>Manager: {{ $manager->name }}</h3>
                        <img src="{{ $manager->image }}" alt="Manager image">
                        <ul>
                            @foreach ($manager->managerReviews as $review)
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

        @endisset
    </main>

</x-user-layout>

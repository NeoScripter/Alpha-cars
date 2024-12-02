@props(['review', 'manager', 'index'])

<div x-show="{{ $index }} < perPage" class="bg-[#F5F5F5] rounded-xl p-6 flex flex-col gap-6 justify-between">
    <div>
        <div class="flex items-start gap-3 mb-1">
            <img src="{{ Storage::url($manager->image) }}" alt="Фото менеджера" class="w-8 h-8 rounded-full">
            <div class="mt-0.5">
                <span class="mt-1">{{ $manager->name }}</span>
                <span class="block text-sm text-gray-400">менеджер</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="font-bold">{{ number_format($review->overallStars, 1) }}</span>
            <x-user.stars :totalStars="$review->overallStars"/>
        </div>
    </div>

    <div class="space-y-5">
        <div class="items-start justify-between gap-1 sm:flex">
            <span class="sm:basis-1/2">Быстро отвечает</span>
            <div class="flex items-center gap-1">
                <x-user.stars :totalStars="$review->responseSpeedStars"/>
            </div>
        </div>
        <div class="items-start justify-between gap-1 sm:flex">
            <span class="sm:basis-1/2">Лучшие цены</span>
            <div class="flex items-center gap-1">
                <x-user.stars :totalStars="$review->priceStars"/>
            </div>
        </div>
        <div class="items-start justify-between gap-1 sm:flex">
            <span class="sm:basis-1/2">Соблюдает договоренности</span>
            <div class="flex items-center gap-1">
                <x-user.stars :totalStars="$review->keepsWordStars"/>
            </div>
        </div>
    </div>

    <div class="flex-1">
        {{ $review->content }}
    </div>

    @if (!Route::is('user.manager'))
    <a href="{{ route('user.manager', $manager->id) }}" class="text-gray-400 underline">Читать все отзывы</a>
    @endif

    <div class="flex items-center gap-3">
        <div class="w-10 h-10 overflow-hidden rounded-full">
            <img src="{{ Storage::url($review->user->image) }}" alt="Пользователь"
                class="object-cover object-center w-full h-full">
        </div>
        {{ $review->user->name }}
    </div>
</div>

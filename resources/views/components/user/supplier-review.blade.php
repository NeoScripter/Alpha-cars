@props(['review', 'index'])

<div x-show="{{ $index }} < perPage" class="bg-[#F5F5F5] rounded-xl p-6 flex flex-col gap-6 justify-between">
    <div class="flex items-center gap-3">
        <span class="font-bold">{{ number_format($review->stars, 1) }}</span>

        <x-user.stars :totalStars="$review->stars" />

    </div>

    <div class="flex-1">
        {{ $review->content }}
    </div>

    <div class="flex items-center gap-3">
        <div class="w-10 h-10 overflow-hidden rounded-full">
            <img src="{{ Storage::url($review->user->image) }}" alt="Пользователь" class="object-cover object-center w-full h-full">
        </div>
        {{ $review->user->name }}
    </div>
</div>

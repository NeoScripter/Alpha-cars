@props([
    'rating' => 4.5,
    'name' => 'Кузьмина Анна',
    'phone' => '+7 (926) 123-45-23',
    'email' => 'admin@rolf.ru',
    'image' => asset('images/png/avatar.jpeg'),
    'id',
    'canReview' => false,
])

<div class="bg-[#FBFBFB] px-4 rounded-lg mx-auto sm:w-5/6 md:px-6 max-w-[1300px] overflow-hidden w-full">
    <div class="flex items-center justify-between mt-4 mb-2 md:mt-3">
        <div class="text-gray-400">менеджер</div>
        <div class="flex items-center gap-2">
            {{ $rating }}
            <img src="{{ asset('images/svgs/star.svg') }}" alt="Желтая звезда" class="w-6 h-6">
        </div>
    </div>
    <div class="flex flex-col items-start gap-4 mb-4 sm:flex-row md:mb-3">
        <div class="flex items-center gap-2 sm:w-1/3 lg:w-120">
            <img src="{{ Storage::url($image) }}" alt="Фото менеджера" class="w-8 h-8 rounded-full md:w-10 md:h-10">
            {{ $name }}
        </div>
        <div>
            <a href="tel:+7 (926) 123-45-23" class="block mb-4 text-blue-600">{{ $phone }}</a>
            <a href="mailto:{{ $email }}" class="block underline">{{ $email }}</a>
        </div>
        <div class="self-end mt-6 ml-auto sm:mt-0">
            @if ($canReview)
                <a href="{{ route('user.manager', $id) . '?review=1' }}"
                    class="block px-6 py-3 mb-2 font-bold text-white transition-colors border bg-black-primary rounded-xl hover:bg-red-primary"
                    type="submit">Оставить отзыв
                </a>
            @endif
            <a href="{{ route('user.manager', $id) }}" class="block ml-auto text-center text-gray-400 underline">Читать
                все
                отзывы</a>
        </div>
    </div>
</div>

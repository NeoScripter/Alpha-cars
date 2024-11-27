@props(['types' => [], 'subtypes' => [], 'makes' => []])

<div x-show="showCarInfo"
    x-transition:enter="transition-all duration-500 ease-in-out"
    x-transition:enter-start="grid-rows-[0fr]"
    x-transition:enter-end="grid-rows-[1fr]"
    x-transition:leave="transition-all duration-500 ease-in-out"
    x-transition:leave-start="grid-rows-[1fr]"
    x-transition:leave-end="grid-rows-[0fr]"
    x-cloak
    class="py-6 border-t border-gray-[#E4E0E0] text-xs sm:text-sm md:text-base text-black grid">
    <div class="bg-[#FBFBFB] px-4 rounded-lg mx-auto sm:w-5/6 max-w-[906px] md:ml-[122px] overflow-hidden">
        <!-- Types -->
        <div class="flex flex-col gap-4 mt-4 mb-6 sm:flex-row">
            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Тип</div>
            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                @foreach ($types as $type)
                    <li>{{ $type }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Subtypes -->
        <div class="flex flex-col gap-4 mb-6 sm:flex-row">
            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Подтип</div>
            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                @foreach ($subtypes as $subtype)
                    <li>{{ $subtype }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Makes -->
        <div class="flex flex-col gap-4 mb-4 sm:flex-row">
            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Марка</div>
            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                @foreach ($makes as $make)
                    <li>{{ $make }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

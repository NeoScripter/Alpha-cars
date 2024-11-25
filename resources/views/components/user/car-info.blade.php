@props(['types' => [], 'subtypes' => [], 'makes' => []])

<div x-show="showCarInfo" x-transition x-cloak
    class="py-6 border-t border-gray-[#E4E0E0] text-xs sm:text-sm md:text-base text-black">
    <div class="bg-[#FBFBFB] p-4 rounded-lg space-y-6 mx-auto sm:w-5/6 max-w-[906px] md:ml-[122px]">
        <!-- Types -->
        <div class="flex flex-col gap-4 sm:flex-row">
            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Тип</div>
            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                @foreach ($types as $type)
                    <li>{{ $type }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Subtypes -->
        <div class="flex flex-col gap-4 sm:flex-row">
            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Подтип</div>
            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                @foreach ($subtypes as $subtype)
                    <li>{{ $subtype }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Makes -->
        <div class="flex flex-col gap-4 sm:flex-row">
            <div class="font-semibold text-xs sm:text-sm md:text-base text-[#999A9A] w-30 shrink-0">Марка</div>
            <ul class="flex flex-wrap gap-4 text-xs text-black sm:text-sm md:text-base">
                @foreach ($makes as $make)
                    <li>{{ $make }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

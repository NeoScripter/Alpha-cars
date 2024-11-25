@props(['images' => []])

<button
    @click="showManagerInfo = !showManagerInfo, showCarInfo = false"
    class="flex justify-between gap-2 p-1 mt-2 rounded-full md:w-full lg:w-auto md:p-2 bg-extra-light-gray">
    <!-- Avatar Grid -->
    <div
        class="grid grid-cols-[repeat(4,8px)] sm:grid-cols-[repeat(4,16px)] md:sm:grid-cols-[repeat(4,8px)] lg:grid-cols-[repeat(4,18px)] gap-1">
        @foreach ($images as $index => $image)
            @if ($index < 3) <!-- Show only the first 4 images -->
                <x-user.avatar :img_path="$image" />
            @endif
        @endforeach
        @if (count($images) > 3)
            <div class="flex items-center justify-center w-6 h-6 p-1 bg-gray-200 rounded-full sm:w-8 sm:h-8">
                +{{ count($images) - 3 }}
            </div>
        @endif
    </div>
    <!-- Dropdown Arrow -->
    <div class="grid content-center p-2 pr-2">
        <svg class="w-2 h-1 rotate-180 sm:w-3 sm:h-2 shrink-0" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M9 5 5 1 1 5" />
        </svg>
    </div>
</button>

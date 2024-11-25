<button
    @click="showCarInfo = !showCarInfo, showManagerInfo = false"
    class="flex gap-2 p-0.5 rounded-full bg-extra-light-gray mt-2">
    <div class="p-1 text-sm bg-gray-200 rounded-full">
        {{ $slot }}
    </div>
    <div class="grid content-center p-1 pr-2">
        <svg class="w-2 h-1 rotate-180 sm:w-3 sm:h-2 shrink-0" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" d="M9 5 5 1 1 5" />
    </svg>
    </div>
</button>

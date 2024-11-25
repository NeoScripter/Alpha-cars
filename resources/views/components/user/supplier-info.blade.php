@props([
    'order' => 1,
    'type' => ['ГА', 'ЛА', 'СТ'],
    'subtype' => ['Тягач'],
    'make' => ['Audi', 'BMW'],
    'name' => 'Рольф',
    'rating' => 'А',
    'terms' => 'АВ - в круг',
    'supervisor' => 'Богатко Олька',
    'avatars' => []
])

<div
    class="grid gap-4 py-6 grid-cols-[repeat(auto-fit,minmax(0px,1fr))] border-t border-gray-[#E4E0E0] text-xs sm:text-sm md:text-base text-black">
    {{-- Choice --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0]">
        <div class="flex items-center me-4">
            <input id="red-checkbox" type="checkbox" value=""
                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-red-primary focus:ring-red-primary dark:focus:ring-red-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="red-checkbox" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">{{ $order }}</label>
        </div>
    </div>
    {{-- Type, Subtype, Make --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] flex flex-col md:flex-row flex-wrap gap-2">
        @if (!empty($type))
            <div>{{ $type[0] }}</div>
            <div class="hidden md:block">{{ $type[1] ?? '' }}</div>
            <div class="hidden md:block">{{ $type[2] ?? '' }}</div>
        @endif
        <span class="block space-y-2 md:hidden">
            <div>{{ $subtype[0] ?? '' }}</div>
            <div>{{ $make[0] ?? '' }}</div>
            <x-user.expand-btn>+{{ max(0, count($make) + count($subtype) + count($type) - 3) }}</x-user.expand-btn>
        </span>

    </div>
    {{-- Subtype --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">
        {{ $subtype[0] ?? '' }}
        <x-user.expand-btn>+{{ count($subtype) - 1 }}</x-user.expand-btn>
    </div>
    {{-- Make --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">
        {{ $make[0] ?? '' }}
        <x-user.expand-btn>+{{ count($make) - 1 }}</x-user.expand-btn>
    </div>
    {{-- Supplier --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden sm:block">{{ $name }}</div>
    {{-- Rating --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">{{ $rating }}</div>
    {{-- Rating, AB --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden sm:block"><span class="md:hidden">А /
        </span>{{ $terms }}</div>
    {{-- Supplier, Rating, Supervisor, Managers --}}
    <div class="sm:mx-1 py-1 md:pr-3 border-r space-y-2 border-gray-[#E4E0E0]">
        <span class="block sm:hidden">{{ $name }}</span>
        <span class="block sm:hidden">{{ $rating }}</span>
        <span class="block lg:hidden">{{ $terms }}</span>
        <span class="block font-medium lg:hidden">{{ $supervisor }}</span>

        <x-user.avatar-btn :images="$avatars" />

    </div>
    {{-- Supervisor --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden lg:block">{{ $supervisor }}</div>
</div>

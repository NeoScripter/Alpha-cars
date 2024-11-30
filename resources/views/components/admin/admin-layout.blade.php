<x-app-layout>
    <x-slot name="header">
        {{ $header ?? '' }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>

            @isset($second)
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    {{ $second }}
                </div>
            </div>
            @endisset
        </div>
    </div>
</x-app-layout>

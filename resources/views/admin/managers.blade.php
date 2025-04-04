
<x-admin-layout>
    {{-- Header Section --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Менеджеры
        </h2>
    </x-slot>

    {{-- First Section --}}
        @include('admin.manager.create')

    {{-- Second Section --}}
    <x-slot name="second">
        @include('admin.manager.index')
    </x-slot>
</x-admin-layout>

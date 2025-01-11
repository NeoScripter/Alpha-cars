
<x-admin-layout>
    {{-- Header Section --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Критерии поиска
        </h2>
    </x-slot>

    {{-- First Section --}}
        @include('admin.criteria.edit')

</x-admin-layout>

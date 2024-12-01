@props([
    'name',
    'label',
    'value' => false,
])

<div class="flex items-center mb-4">
    <input
        id="{{ $name }}"
        type="checkbox"
        name="{{ $name }}"
        value="1"
        class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black dark:focus:ring-black dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        @if($value) checked @endif
    />
    <label
        for="{{ $name }}"
        class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300"
    >
        {{ $label }}
    </label>
</div>

@if ($errors->has($name))
    <div class="mt-1 text-sm text-red-500">
        {{ $errors->first($name) }}
    </div>
@endif

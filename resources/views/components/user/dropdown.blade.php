<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $slot }}
    </label>
    <select
        id="{{ $name }}"
        name="{{ $name }}[]"
        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
        @change="addToArray('{{ $name }}', $event.target.value)"
    >
        <option value="" disabled selected class="{{ $selected ? '' : 'hidden' }}"></option>
        @foreach ($options as $key => $value)
            @if ($key != $selected)
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
</div>

<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">
        {{ $slot }}
    </label>

    <template x-for="(value, index) in fields['{{ $name }}']" :key="index">
        <input type="hidden" :name="'{{ $name }}[]'" :value="value">
    </template>

    <select
        id="{{ $name }}"
        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
        @change="addToArray('{{ $name }}', $event.target.value)"
    >
        <option value="" disabled selected class="{{ $selected ? '' : 'hidden' }}"></option>
        @foreach ($options as $value)
            @if ($value != $selected)
                <option value="{{ $value }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
</div>

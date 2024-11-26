<div class="mb-4">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $slot }}
    </label>
    <div class="flex space-x-4">
        @foreach ($options as $value)
            <div>
                <!-- Hidden Checkbox -->
                <input
                    type="checkbox"
                    id="{{ $value }}"
                    name="{{ $name }}[]"
                    value="{{ $value }}"
                    class="absolute pointer-events-none checkbox-input peer"
                >

                <!-- Label -->
                <label
                    for="{{ $value }}"
                    class="block w-full px-6 py-3 text-sm text-gray-900 transition-colors border border-gray-300 rounded-full cursor-pointer peer-checked:text-red-500 peer-checked:bg-[#FFEDED] peer-checked:border-[#FFEDED] focus:ring-red-500 focus:border-red-500 hover:border-gray-500 peer-checked:hover:border-gray-300"
                >
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>

</div>

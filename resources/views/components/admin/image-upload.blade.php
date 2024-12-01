<div>
    <p class="block mb-1 text-sm font-medium text-gray-700">{{ $label }}</p>

    @isset ($imagePath)
        <div>
            <figure class="relative max-w-sm mb-1">
                <img class="rounded-lg" src="{{ Storage::url($imagePath) }}" alt="{{ $altText ?? 'Image' }}">
            </figure>
        </div>
    @endisset

    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="{{ $inputId }}">
        {{ $newLabel }}
    </label>
    <input
        class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="{{ $inputId }}" name="{{ $inputName }}" type="file">
</div>

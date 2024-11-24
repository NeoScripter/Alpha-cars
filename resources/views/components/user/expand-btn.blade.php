<button class="flex gap-2 p-0.5 rounded-full bg-extra-light-gray mt-2">
    <div class="p-1 text-sm bg-gray-200 rounded-full">
        {{ $slot }}
    </div>
    <div class="grid content-center p-1 pr-2">{!! file_get_contents(asset('images/svgs/arrowdown.svg')) !!}</div>
</button>

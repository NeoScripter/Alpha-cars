@props(['img_path' => asset('images/default-avatar.png')])

<div class="sm:w-8 sm:h-8 w-6 h-6 p-0.5 overflow-hidden bg-white rounded-full">
    <img src="{{ $img_path }}" alt="Аватар менеджера"
        class="object-contain object-center w-full h-full rounded-full">
</div>

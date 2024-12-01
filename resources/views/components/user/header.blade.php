<header class="flex items-center justify-between gap-2 p-4 border-b border-gray-250 sm:px-5 md:px-10 lg:py-4 lg:px-20">
    <a href="{{ route('user.index') }}" class="block h-10 w-37">
        <img src="{{ asset('images/svgs/logo.svg') }}" alt="Лого компании Альфа Лизинг" class="object-contain object-center w-full h-full">
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="block px-6 py-3 font-bold transition-colors border rounded-2xl text-red-primary border-red-primary hover:text-white hover:bg-red-primary">Выйти</button>
    </form>
</header>

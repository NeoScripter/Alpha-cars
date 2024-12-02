<section>
    <div>
        <h2 class="flex flex-wrap items-center justify-between gap-4 text-lg font-medium text-gray-900">
            Все пользователи

            <form class="max-w-sm sm:ml-auto w-100 shrink-0" method="GET"
                onsubmit="event.preventDefault(); window.location.href = '/admin/users/' + encodeURIComponent(this.search.value);">
                <label for="default-search"
                    class="text-sm font-medium text-gray-900 sr-only dark:text-white">Поиск</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" name="search" id="default-search"
                        class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-gray-900 focus:border-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Найти пользователя..." />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-gray-900 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Поиск</button>
                </div>
            </form>
        </h2>
    </div>

    <div class="mt-4 space-y-6">

        @if (isset($users))
            @if ($users->isNotEmpty())
                @foreach ($users as $user)
                    <hr>
                    <div>
                        <div>
                            <p class="block mb-1 font-bold text-black font-sm text-md">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="block mb-1 text-gray-700 font-sm text-md">Email: {{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="block mb-1 text-gray-700 font-sm text-md">Роль: {{ $user->role === 'user' ? 'Пользователь' : 'Редактор'}}</p>
                        </div>
                        @isset ($user->image)
                            <div>
                                <figure class="relative max-w-sm mb-1">
                                    <img class="rounded-lg" src="{{ Storage::url($user->image) }}"
                                        alt="Фото пользователя">
                                </figure>
                            </div>
                        @endisset

                        <x-admin.link href="{{ route('admin.users.edit', $user) }}">{{ __('Редактировать') }}</x-admin.link>

                        @if (Auth::user()->role === 'admin' || (Auth::user()->role === 'editor' && $user->role === 'user'))
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <x-admin.danger-button
                                    onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">
                                    {{ __('Удалить') }}
                                </x-admin.danger-button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="no-users-message">Не найдено ни одного пользователя</p>
            @endif

            {{ $users->links() }}
        @else
            <p class="no-users-message">Нет ни одного пользователя</p>
        @endif

    </div>
</section>

@if (session('status') === 'success')
    <div class="fixed flex items-center p-4 space-x-4 text-gray-500 -translate-x-1/2 bg-white divide-x divide-gray-200 rounded-lg shadow w-max left-1/2 rtl:divide-x-reverse top-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
        role="alert" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
        <div class="text-base font-normal text-center text-gray-600">
            {{ session('message') }}
        </div>
    </div>
@endif

<section>
    <div>
        <h2 class="flex flex-wrap items-center justify-between gap-4 text-lg font-medium text-gray-900">
            Все пользователи

            <x-admin.search-form :action="'/admin/users/'" :placeholder="'Найти пользователя...'" />
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
                                    <img class="rounded-lg max-w-32" src="{{ Storage::url($user->image) }}"
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

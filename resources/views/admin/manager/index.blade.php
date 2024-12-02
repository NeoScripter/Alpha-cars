<section>
    <div>
        <h2 class="flex flex-wrap items-center justify-between gap-4 text-lg font-medium text-gray-900">
            Все менеджеры

            <x-admin.search-form :action="'/admin/managers/'" :placeholder="'Найти менеджера...'" />
        </h2>
    </div>

    <div class="mt-4 space-y-6">

        @if (isset($managers))
            @if ($managers->isNotEmpty())
                @foreach ($managers as $manager)
                    <hr>
                    <div>
                        <div>
                            <p class="block mb-1 font-bold text-black font-sm text-md">{{ $manager->name }}</p>
                        </div>
                        <div>
                            <p class="block mb-1 text-gray-700 font-sm text-md">Телефон: {{ $manager->phone }}</p>
                        </div>
                        <div>
                            <p class="block mb-1 text-gray-700 font-sm text-md">Email: {{ $manager->email }}</p>
                        </div>
                        <div>
                            <p class="block mb-1 text-gray-700 font-sm text-md">Поставщик: {{ $manager->supplier->name ?? 'Не назначен' }}</p>
                        </div>
                        @if ($manager->image)
                            <div>
                                <figure class="relative max-w-sm mb-1">
                                    <img class="rounded-lg max-w-32" src="{{ Storage::url($manager->image) }}"
                                        alt="Фото менеджера">
                                </figure>
                            </div>
                        @endif

                        <x-admin.link
                            href="{{ route('admin.manager.edit', $manager) }}">{{ __('Редактировать') }}</x-admin.link>
                    </div>
                @endforeach
            @else
                <p class="no-managers-message">Не найдено ни одного менеджера</p>
            @endif

            {{ $managers->links() }}
        @else
            <p class="no-managers-message">Нет ни одного менеджера</p>
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

<section>
    <div>
        <h2 class="flex flex-wrap items-center justify-between gap-4 text-lg font-medium text-gray-900">
            Все поставщики

            <x-admin.search-form :action="'/admin/'" :placeholder="'Найти поставщика...'" />
        </h2>
    </div>

    <div class="mt-4 space-y-6">

        @if (isset($suppliers))
            @if ($suppliers->isNotEmpty())
                @foreach ($suppliers as $supplier)
                    <hr>
                    <div>
                        <div>
                            <p class="block mb-1 font-bold text-black font-sm text-md">{{ $supplier->name }}</p>
                        </div>
                        <div>
                            <p class="block mb-1 text-gray-700 font-sm text-md">Адрес платформы: {{ $supplier->platform_address }}</p>
                        </div>
                        @if ($supplier->image)
                            <div>
                                <figure class="relative max-w-sm mb-1">
                                    <img class="rounded-lg max-w-32" src="{{ Storage::url($supplier->image) }}"
                                        alt="Фото поставщика">
                                </figure>
                            </div>
                        @endif

                        <div>
                            <p class="block max-w-xl font-normal text-black font-sm text-md">{!! $supplier->workTerms !!}</p>
                        </div>
                        <x-admin.link
                            href="{{ route('supplier.edit', $supplier) }}">{{ __('Редактировать') }}</x-admin.link>
                    </div>
                @endforeach
            @else
                <p class="no-suppliers-message">Не найдено ни одного поставщика</p>
            @endif

            {{ $suppliers->links() }}
        @else
            <p class="no-suppliers-message">Нет ни одного поставщика</p>
        @endif

    </div>
</section>

@if (session('status') === 'supplier-deleted')
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
        {{ __('Поставщик удален.') }}</p>
@endif

@if (session('status') === 'success')
    <div class="fixed flex items-center p-4 space-x-4 text-gray-500 -translate-x-1/2 bg-white divide-x divide-gray-200 rounded-lg shadow w-max left-1/2 rtl:divide-x-reverse top-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
        role="alert" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
        <div class="text-base font-normal text-center text-gray-600">
            {{ session('message') }}
        </div>
    </div>
@endif

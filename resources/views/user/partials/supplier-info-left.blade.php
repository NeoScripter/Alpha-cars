<div class="flex flex-col justify-between gap-4 sm:flex-1">
    <div class="bg-[#F5F5F5] rounded-xl p-6 flex-1">
        <p class="mb-1 text-gray-400">юридическое лицо</p>
        <div class="mb-4">{{ $supplier->legal_entity }}</div>
        <p class="mb-1 text-gray-400">ИНН</p>
        <div class="mb-4">{{ $supplier->itn }}</div>
        <p class="mb-1 text-gray-400">КПП</p>
        <div class="mb-4">{{ $supplier->rrc }}</div>
    </div>

    <div class="bg-[#F5F5F5] rounded-xl p-6 flex-1">
        <div class="flex items-start">
            <div class="flex-1">
                <p class="mb-1 text-gray-400">рейтинг</p>
                <div class="mb-4">{{ $supplier->rating }}</div>
            </div>
            <div class="flex-1">
                <p class="mb-1 text-gray-400">тип техники</p>
                <ul class="mb-4">
                    @foreach ($supplier->carType as $type)
                        <li>{{ $type }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <p class="mb-1 text-gray-400">марки</p>
        <div class="mb-4">{{ implode(', ', $supplier->carMake) }}</div>
    </div>

</div>

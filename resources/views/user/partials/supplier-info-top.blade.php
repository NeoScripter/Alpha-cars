<div class="lg:basis-1/4 md:basis-[47%]">
    <div class="border-b border-gray-[#E4E0E0] flex items-start gap-3 p-4">
        <img src="{{ asset('images/svgs/supplier-email.svg') }}" alt="email" class="pt-1">
        <ul class="space-y-2">
            @foreach ($supplier->emails as $email)
                <li class="block">{{ $email }}</li>
                <li class="block">{{ $email }}</li>
                <li class="block">{{ $email }}</li>
            @endforeach
        </ul>
    </div>
    <div class="border-b border-gray-[#E4E0E0] flex items-start gap-3 p-4">
        <img src="{{ asset('images/svgs/supplier-website.svg') }}" alt="phone" class="pt-1">
        <a class="block underline" href="{{ $supplier->website }}">{{ $supplier->website }}</a>
    </div>
    <div class="border-b border-gray-[#E4E0E0] flex items-start gap-3 p-4">
        <img src="{{ asset('images/svgs/supplier-call.svg') }}" alt="website" class="pt-1">
        <ul class="space-y-2">
            @foreach ($supplier->phones as $phone)
                <li class="block">{{ $phone }}</li>
                <li class="block">{{ $phone }}</li>
                <li class="block">{{ $phone }}</li>
            @endforeach
        </ul>
    </div>
    <div class="border-b border-gray-[#E4E0E0] p-4">
        <p class="mb-2 text-gray-400">адрес площадки</p>
        <div class="flex items-start gap-3">
            <img src="{{ asset('images/svgs/supplier-address.svg') }}" alt="location" class="pt-1">
            <div>
                {{ $supplier->platform_address }}
            </div>
        </div>
    </div>
    <div class="border-b border-gray-[#E4E0E0] p-4">
        <p class="mb-2 text-gray-400">адрес отгрузки</p>
        <div class="flex items-start gap-3">
            <img src="{{ asset('images/svgs/supplier-address.svg') }}" alt="location" class="pt-1">
            <div>
                {{ $supplier->unload_address }}
            </div>
        </div>
    </div>
</div>

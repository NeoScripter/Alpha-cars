<div
    class="grid gap-4 py-6 grid-cols-[repeat(auto-fit,minmax(0px,1fr))] border-t border-gray-[#E4E0E0] font-semibold text-xs sm:text-sm md:text-base text-[#999A9A]">
    {{-- Choice --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0]">Выбрать</div>

    {{-- Type, Subtype, Make --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0]">Тип<span class="md:hidden"> / Подтип /
            Марка</span></div>
    {{-- Subtype --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">Подтип</div>
    {{-- Make --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">Марка</div>

    {{-- Supplier --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden sm:block">Поставщик</div>
    {{-- Rating --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden md:block">Рейтинг</div {{-- Rating, AB --}}>
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden sm:block"><span class="md:hidden">Рейтинг /
        </span>АВ</div>

    {{-- Supplier, Rating, Supervisor, Managers --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0]"><span class="sm:hidden">Поставщик / Рейтинг /
        </span><span class="lg:hidden">Куратор / </span>Персонал</div>
    {{-- Supervisor --}}
    <div class="mx-1 py-1 border-r border-gray-[#E4E0E0] hidden lg:block">Куратор</div>

</div>

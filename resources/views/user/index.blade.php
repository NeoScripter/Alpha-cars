<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        <h1 class="mb-6 text-2xl sm:mb-8 font-regular">Поиск поставщика</h1>

        @include('user.partials.search-input')

        <section id="table">
            <x-user.table-head />

            @isset($suppliers)
                @foreach ($suppliers as $index => $supplier)
                    <div x-data="{ showCarInfo: false, showManagerInfo: false }">


                        <x-user.supplier-info :order="$index + 1" :type="$supplier->carType" :subtype="$supplier->carSubtype" :make="$supplier->carMake"
                            :name="$supplier->name" :rating="$supplier->rating" :terms="$supplier->workTerms" :supervisor="$supplier->supervisor"
                            :avatars="$supplier->managers->pluck('image')->toArray()"
                            :id="$supplier->id" />



                        @isset($supplier->managers)
                            @php
                                $manager_count = count($supplier->managers);
                            @endphp
                            <div x-show="showManagerInfo"
                            x-transition:enter="transition-all duration-500 ease-in-out"
                            x-transition:enter-start="grid-rows-[repeat(20,0fr)]"
                            x-transition:enter-end="grid-rows-[repeat(20,1fr)]"
                            x-transition:leave="transition-all duration-500 ease-in-out"
                            x-transition:leave-start="grid-rows-[repeat(20,1fr)]"
                            x-transition:leave-end="grid-rows-[repeat(20,0fr)]"
                            x-cloak
                                class="py-6 border-t border-gray-[#E4E0E0] text-sm md:text-base text-black space-y-2 grid">
                                @foreach ($supplier->managers as $manager)
                                    <x-user.manager-info :rating="$manager->stars" :name="$manager->name" :phone="$manager->phone"
                                        :email="$manager->email" :image="$manager->image" :id="$manager->id" />
                                @endforeach
                            </div>
                        @endisset

                        <x-user.car-info :types="$supplier->carType" :subtypes="$supplier->carSubtype" :makes="$supplier->carMake" />
                    </div>
                @endforeach
            @endisset
        </section>

        @isset($suppliers)
            {{ $suppliers->appends(request()->except('page'))->links() }}
        @endisset

    </main>

</x-user-layout>

<x-user-layout>

    <x-user.header />

    <main class="px-4 pt-10 pb-5 sm:px-5 md:px-10 lg:px-20 lg:pt-20 lg:pb-10 ">
        @isset($supplier)
            <ul>
                <li>{{ $supplier->image }}</li>
                <li>{{ $supplier->name }}</li>
                <li>{{ $supplier->stars }}</li>
                <li>{{ $supplier->website }}</li>
                <li>{{ $supplier->platform_address }}</li>
                <li>{{ $supplier->unload_address }}</li>
                <li>{{ $supplier->legal_entity }}</li>
                <li>{{ $supplier->itn }}</li>
                <li>{{ $supplier->rrc }}</li>
                <li>{{ $supplier->rating }}</li>
                <li>{{ $supplier->workTerms }}</li>
                <li>{{ $supplier->supervisor }}</li>
                <li>{{ $supplier->dkp }}</li>
                <li>{{ $supplier->image_spec }}</li>
                <li>{{ $supplier->signees }}</li>
                <li>{{ $supplier->warantees }}</li>
                <li>{{ $supplier->payWithoutPTC }}</li>

                @foreach ($supplier->emails as $email)
                    <li>{{ $email }}</li>
                @endforeach

                @foreach ($supplier->phones as $phone)
                    <li>{{ $phone }}</li>
                @endforeach

                @foreach ($supplier->carType as $type)
                    <li>{{ $type }}</li>
                @endforeach

                @foreach ($supplier->carSubtype as $subtype)
                    <li>{{ $subtype }}</li>
                @endforeach

                @foreach ($supplier->carMake as $make)
                    <li>{{ $make }}</li>
                @endforeach
            </ul>

            <!-- Supplier Reviews -->
            <section>
                <h2>Supplier Reviews</h2>
                <ul>
                    @foreach ($supplier->supplierReviews as $review)
                        <li>
                            <strong>Reviewer:</strong> {{ $review->user->name }}
                            <img src="{{ $review->user->image }}" alt="User image">
                            <p><strong>Stars:</strong> {{ $review->stars }}</p>
                            <p><strong>Review:</strong> {{ $review->content }}</p>
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Manager Reviews -->
    <section>
        <h2>Manager Reviews</h2>
        @foreach ($supplier->managers as $manager)
            <div>
                <h3>Manager: {{ $manager->name }}</h3>
                <img src="{{ $manager->image }}" alt="Manager image">
                <ul>
                    @foreach ($manager->managerReviews as $review)
                        <li>
                            <strong>Reviewer:</strong> {{ $review->user->name }}
                            <img src="{{ $review->user->image }}" alt="User image">
                            <p><strong>Overall Stars:</strong> {{ $review->overallStars }}</p>
                            <p><strong>Response Speed:</strong> {{ $review->responseSpeedStars }}</p>
                            <p><strong>Price:</strong> {{ $review->priceStars }}</p>
                            <p><strong>Keeps Word:</strong> {{ $review->keepsWordStars }}</p>
                            <p><strong>Review:</strong> {{ $review->content }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </section>

        @endisset
    </main>

</x-user-layout>

<div x-show="showPopup" x-cloak x-transition class="fixed inset-0 z-20 pt-4 sm:pt-8 md:pt-12 bg-black/50">

    <div @click.away="showPopup = false" class="p-4 md:p-6 mx-auto space-y-4 bg-white rounded-xl max-w-[768px]">

        <div class="flex items-center justify-between gap-2">
            <div class="text-2xl font-bold">Новый отзыв</div>
            <button
                @click="showPopup = false"
                class="w-8 h-8 p-2">
                <img class="w-full h-full" src="{{ asset('images/svgs/close.svg') }}" alt="Close button">
            </button>
        </div>

        <form class="space-y-4" action="{{ route('supplier-review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="supplier_id" :value="{{ $supplier->id }}">
            <div class="bg-[#F5F5F5] rounded-xl p-4 md:p-6">

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full overflow-clip">
                        <img class="w-full h-full" src="{{ isset($supplier->image) ? Storage::url($supplier->image) : '' }}" alt="{{ $supplier->name }}">
                    </div>

                    <div>
                        <div class="mb-4 text-xl font-bold">{{ $supplier->name }}</div>

                        <div x-data="{
                            score: {{ old('stars', 0) }},
                            isSet: {{ old('stars') ? 'true' : 'false' }},
                            showScore(value) {
                                if (!this.isSet) {
                                    this.score = value;
                                }
                            },
                            setScore(value) {
                                this.isSet = true;
                                this.score = value;
                            },
                        }">
                            <div class="flex gap-3">
                                <template x-for="i in 5" :key="i">
                                    <svg
                                        @click="setScore(i)"
                                        @mouseover="showScore(i)"
                                        @mouseleave="showScore(0)"
                                        :class="i <= score ? 'text-yellow-400' : 'text-gray-300'"
                                        class="w-6 h-6 cursor-pointer fill-current"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                    >
                                    <path d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.781 1.4 8.16L12 18.897l-7.334 3.853 1.4-8.16L.133 9.209l8.2-1.191z"/>
                                    </svg>
                                </template>
                            </div>

                            <input type="hidden" name="stars" :value="isSet ? score : 0">
                        </div>
                    </div>
                </div>


            </div>

            <ul class="text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <div class="bg-[#F5F5F5] rounded-xl p-4">
                <textarea name="content" rows="6" class="w-full bg-gray-100 border-none rounded-xl focus:ring-red-500 focus:border-red-500" placeholder="Опишите плюсы и минусы"></textarea>
            </div>
            <button class="block w-full px-6 py-3 mt-8 font-bold text-white transition-colors border bg-red-primary rounded-xl hover:bg-black-primary">Оставить отзыв</button>
        </form>
    </div>

</div>

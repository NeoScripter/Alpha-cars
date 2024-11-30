<div>
    <x-admin.input-label :for="$name" :value="$label" />

    @if ($isTextarea)
        <x-admin.text-area :id="$name" :name="$name" class="block w-full mt-1" rows="4">{{ $value }}</x-admin.text-area>
    @else
        <x-admin.text-input :id="$name" :name="$name" :type="$type" class="block w-full mt-1" :value="$value" />
    @endif

    <x-admin.input-error :messages="$errors->get($name)" class="mt-2" />
</div>

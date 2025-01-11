@props([
    'fieldName' => '',
    'label',
    'singularLabel',
    'placeholder' => '',
    'values' => [], // Initial values for the selects
    'options' => [], // Array of options (label and value are the same)
])

<div x-data="{
    items: {{ json_encode($values) }},
    options: {{ json_encode($options) }},
    placeholder: '{{ $placeholder }}',
    fieldName: '{{ $fieldName }}',
    addItem() {
        this.items.push(''); // Add a new empty item
    },
    removeItem(index) {
        this.items.splice(index, 1); // Remove an item by index
    }
}">
    <x-admin.input-label :for="$fieldName" :value="$label" />

    <!-- Dynamic select fields -->
    <template x-for="(item, index) in items" :key="index">
        <div class="flex items-center mb-2 space-x-2">
            <!-- Select field -->
            <select
                :name="`${fieldName}[${index}]`"
                x-model="items[index]"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            >
                <option value="" x-bind:selected="item === ''">{{ $placeholder }}</option>
                <template x-for="option in options" :key="option">
                    <option :value="option" x-text="option" x-bind:selected="item === option"></option>
                </template>
            </select>

            <!-- Remove button -->
            <x-admin.danger-button type="button" @click="removeItem(index)" class="py-3 mt-1">
                Удалить
            </x-admin.danger-button>
        </div>
    </template>

    <!-- Add new item button -->
    <x-admin.primary-button type="button" @click="addItem" class="mt-2">
        Добавить {{ $singularLabel }}
    </x-admin.primary-button>

    <x-admin.input-error :messages="$errors->get($fieldName)" class="mt-2" />
</div>

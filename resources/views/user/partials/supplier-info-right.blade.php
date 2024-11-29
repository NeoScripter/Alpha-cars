<div class="bg-[#F5F5F5] rounded-xl p-6 sm:flex-1">
    <p class="mb-1 text-gray-400">дкп согласовано</p>
    <div class="mb-4">{{ $supplier->dkp ? 'да' : 'нет' }}</div>
    <p class="mb-1 text-gray-400">спецификация картинкой</p>
    <div class="mb-4">{{ $supplier->image_spec ? 'да' : 'нет' }}</div>
    <p class="mb-1 text-gray-400">АВ</p>
    <div class="mb-4">{{ $supplier->workTerms }}</div>
    <p class="mb-1 text-gray-400">куратор</p>
    <div class="mb-4">{{ $supplier->supervisor }}</div>
    <p class="mb-1 text-gray-400">подписанты</p>
    <div class="mb-4">{{ $supplier->signees }}</div>
    <p class="mb-1 text-gray-400">гарантии</p>
    <div class="mb-4">{{ $supplier->warantees ? 'да' : 'нет' }}</div>
    <p class="mb-1 text-gray-400">можем ли оплачивать без ПТС</p>
    <div class="mb-4">{{ $supplier->payWithoutPTC ? 'да' : 'нет' }}</div>
</div>

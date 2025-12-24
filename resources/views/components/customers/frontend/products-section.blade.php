@props(['products' => []])
<div class="flex gap-2.5 overflow-x-auto no-scrollbar snap-x snap-mandatory rounded-md">
    @foreach ($products as $product )
    <div wire:key="product-{{ $product->sku }}" class="w-full max-w-sm mx-auto">
        <x-customers.frontend.single-product-card :product="$product"/>
    </div>
    @endforeach
</div>
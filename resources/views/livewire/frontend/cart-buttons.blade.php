<div >
    <!-- Quantity Selector -->
    <div class="mt-3">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-gray-700">Jumlah:</span>
            <div class="flex items-center">
                <button wire:click="decrement" class="quantity-btn bg-gray-200 text-gray-600 rounded-l-md">
                    <i class="fas fa-minus text-xs"></i>
                </button>
                <input wire:model="quantity" type="number" class="bg-gray-50 border-x-0 border-gray-300 h-7 text-center w-15 py-0 text-xs"  disabled readonly>
                <button wire:click="increment" class="quantity-btn bg-gray-200 text-gray-600 rounded-r-md">
                    <i class="fas fa-plus text-xs"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="mt-2 text-center">
        @error('quantity')
        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <!-- Action Buttons -->
    <div class="mt-4 flex space-x-2">
        <button wire:click="addToCart()" wire:loading.attr="disabled" class="flex-1 action-btn bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium flex items-center justify-center transition">
            <span wire:loading.remove wire:target="addToCart">
                {{-- <i class="fas fa-shopping-cart text-xs mr-1"></i>  --}}
                <span class="text-xs">Keranjang</span>
            </span>
            <div wire:loading wire:target="addToCart" class="animate-spin inline-block size-5 border-3 border-current border-t-transparent text-white rounded-full " role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </button>
        <button wire:click="buyNowButton" class="flex-1 action-btn bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium flex items-center justify-center transition">
            {{-- <i class="fas fa-bolt text-xs mr-1"></i>  --}}
            <span wire:loading.remove wire:target="buyNowButton">
                <span class="text-xs">Beli</span>
            </span>
            <div wire:loading wire:target="buyNowButton" class="animate-spin inline-block size-5 border-3 border-current border-t-transparent text-white rounded-full " role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </button>
    </div>
</div>



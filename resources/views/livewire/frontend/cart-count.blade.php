<div>
    <div class="flex items-center space-x-4">
        {{-- Icon Cart --}}
        <a href="{{ route('product.carts')}}"
        class="relative inline-flex items-center justify-center p-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-gray-100 transition">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
            {{-- Badge jumlah item --}}
            <span
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5 py-0.5">
                {{ $count }}
            </span>
        </a>
    </div>
</div>

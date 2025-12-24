
<div class="product-card relative bg-white rounded-xl shadow-md overflow-hidden m-auto">
        <!-- Product Badge -->
        {{-- <div class="absolute top-3 left-3">
            <span class="badge bg-red-500 text-white font-semibold rounded">SALE</span>
        </div> --}}
        
        <!-- Wishlist Button -->
        <div class="absolute top-3 right-3">
            <button class="wishlist-btn bg-white p-1.5 rounded-full shadow-sm text-sm">
                <i class="far fa-heart text-gray-500"></i>
            </button>
        </div>
        
        <!-- Product Image -->
        <a href="{{ route('product.details', $product->slug) }}">
            <div class="h-48 w-full bg-gray-100 flex items-center justify-center p-4">
                <img src="{{ $product->cover_url }}" alt="{{ $product->name }}" class="h-40 w-full">
            </div>
        </a>
        
        <!-- Product Details -->
        <div class="p-4">
            <!-- Product Name -->
            <a href="{{ route('product.details', $product->slug) }}">
            <h2 class="mt-1 text-2md font-semibold hover:underline text-gray-900 leading-tight">{{ $product->name }}</h2>
            </a>
            
            <!-- Category -->
            <div class="tracking-wide text-xs text-blue-500 font-semibold">{{ $product->category }}</div>
            
            <!-- Rating -->
            <div class="mt-1 flex items-center">
                <div class="flex text-yellow-400 text-xs">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="text-gray-600 text-xs ml-1">4.5 (128)</span>
            </div>
            
            <!-- Price -->
            <div class="mt-2 flex items-center">
                <span class="text-md font-bold text-gray-900">{{ $product->price_formatted }}</span>
                {{-- <span class="ml-2 text-xs text-gray-500 line-through">Rp 1.599.000</span>
                <span class="ml-2 text-xs font-semibold text-green-600">19%</span> --}}
            </div>
            
            <!-- Stock Information -->
            <div class="mt-3">
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Tipe: <span class="font-semibold">{{ $product->type }}</span></span>
                </div>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Stok: <span class="font-semibold">{{ $product->stock }}</span></span>
                    <span>Terjual: <span class="font-semibold">158</span></span>
                </div>
                <div class="mt-1 w-full bg-gray-200 rounded-full">
                    {{-- <div class="bg-green-600 h-1.5 rounded-full" style="width: 75%"></div> --}}
                </div>
            </div> 
            {{-- {{ dd($product) }} --}}
            <livewire:frontend.cart-buttons :product="$product" :type="$product->type->value" :key="'card-button-'.$product->sku"/>

            <!-- Additional Info -->
            <div class="mt-3 flex items-center text-xs text-gray-500">
                {{-- <i class="fas fa-truck mr-1"></i>
                <span>Gratis Ongkir</span> --}}
            </div>
        </div>
</div>
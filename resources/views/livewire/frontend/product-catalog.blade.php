<div>
     <div class="container mx-auto px-2 py-4">
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-primary-800">Katalog Produk</h1>
            <p class="text-gray-600">Temukan produk terbaik dengan harga terbaik</p>
        </header>
        @if (session('status'))
        <x-customers.frontend.toast-success />
        @endif
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Filter Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-lg  p-6 mb-6">
                <h1 class="text-md font-bold text-primary-800">Pencarian</h1>
                <div class="mb-6 mt-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input wire:model.live.debounce.250ms="search" type="text" id="search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500" placeholder="Cari produk berdasarkan merek, kode, atau ukuran produk ..." autofocus>
                        <div class="absolute inset-y-0 right-3 flex items-center pl-3 pointer-events-none">
                            <div wire:loading wire:target="search" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-primary-600 rounded-full dark:text-primary-500" role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    @error('search')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <h2 class="text-md font-semibold text-primary-800 mb-4">Kategori</h2>
                    <!-- Category List -->
                    <ul class="space-y-2">
                        @foreach ($categories as $i =>  $category )
                        <li class="flex justify-between items-center">
                            <div class="flex items-center">
                                <input wire:model="select_category" value="{{ $category->id }}" id="category-{{ $i }}" type="checkbox" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500">
                                <label for="category-{{ $i }}" class="ml-2 text-sm text-gray-700">{{ $category->name }}</label>
                            </div>
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">({{ $category->product_count }})</span>
                        </li>
                        @endforeach
                    </ul>
                    @error('select_category')
                    <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-6 flex gap-2">
                    <button  wire:click="applyFilters" wire:laoding.attr="disabled" class="flex-1 bg-primary-700 hover:bg-primary-800 text-white py-2 px-2 rounded-sm transition duration-200">
                        <span wire:loading.remove wire:target="applyFilters" class="text-sm">Terapkan Filter</span>
                        <div wire:loading wire:target="applyFilters" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white-600 rounded-full dark:text-white-500" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button wire:click="resetFilters" wire:laoding.attr="disabled" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-2 rounded-sm transition duration-200">
                        <span wire:loading.remove wire:target="resetFilters" class="text-sm">Reset Filter</span>
                        <div wire:loading wire:target="resetFilters" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-primary-600 rounded-full dark:text-primary-500" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
                </div>
            </div>

            <!-- Product Listing & Sort -->
            <div class="w-full md:w-3/4">
                <!-- Results and Sort Header -->
                <div class="bg-white rounded-lg  p-2 mb-4">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <p class="text-gray-700">Hasil: <span class="font-semibold">{{ ($products) ? $products->total() : '0' }} item</span></p>
                        
                        <div class="flex items-center">
                            <div class="block">                            
                                <label for="sort" class="text-sm font-medium text-gray-700 mr-2">Sortir:</label>
                                <select wire:model.live="sort_by" id="sort" class="text-sm border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2">
                                    <option value="newest">Pilih Opsi Filter</option>
                                    <option value="latest">Produk Terbaru</option>
                                    <option value="price_asc">Produk Termurah</option>
                                    <option value="price_desc">Produk Termahal</option>
                                    <option value="best_seller">Produk Terlaris</option>
                                </select>
                                @error('sort_by')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 justify-items-center">
                    @forelse ($products as $product )
                    <div wire:key="product-{{ $product->sku }}" class="w-full max-w-sm mx-auto">
                    <x-customers.frontend.single-product-card :product="$product"/>
                    </div>
                    @empty
                    <div class="col-span-full">
                        <x-customers.frontend.not-found-page />
                    </div>
                     @endforelse
                </div>
                @if ($products)
                <div class="mt-2.5">
                    {{ $products->links() }}
                </div>
                @endif
                {{-- paginate --}}
            </div>
        </div>
    </div>
</div>



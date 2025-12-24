<div>

    <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800">Rekomendasi Produk Dari Kami </h2>
    <div class="inline-flex items-center justify-center w-full">
        <hr class="w-64 h-1 my-8 bg-primary-200 border-0 rounded-sm dark:bg-primary-700">
        <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2 dark:bg-gray-900">
            <svg class="w-4 h-4 text-primary-700 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
            </svg>
        </div>
    </div>

    <div class="max-w-7xl mx-auto shadow-md bg-gray-200  py-6 px-6 rounded-md">
        <div class="mb-3 flex justify-between">
            <h1 class="text-xl font-medium text-gray-800">Produk Terbaru</h1>
            <a href="{{ route('product.catalog') }}" class="text-sm underline hover:text-primary-800">Lihat semua produk
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <x-customers.frontend.products-section :products="$newest_product"/>

        <div class="mb-3 mt-7 flex justify-between">
            <h1 class="text-xl font-medium text-gray-800">Produk Terlaris</h1>
            <a href="{{ route('product.catalog') }}" class="text-sm underline hover:text-primary-800">Lihat semua produk
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <x-customers.frontend.products-section :products="$best_seller_product" />

    </div>

</div>

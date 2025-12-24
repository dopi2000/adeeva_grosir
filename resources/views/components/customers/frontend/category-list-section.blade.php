 <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800">Jenis Produk Yang Kami Tawarkan</h2>
            <p class="text-gray-600 text-center max-w-2xl mx-auto">Temukan berbagai produk berkualitas dengan desain terbaru untuk melengkapi kebutuhan bisnis anda</p>

            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-64 h-1 my-8 bg-primary-200 border-0 rounded-sm">
                <div class="absolute px-4 -translate-x-1/2 bg-white left-1/2">
                    <svg class="w-4 h-4 text-primary-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
            </svg>
                </div>
            </div>

            <div class="flex overflow-x-auto pb-5 space-x-4 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-x-0 hide-scrollbar">
                <!-- Card Sandal -->
                <div class="flex-shrink-0 w-4/5 sm:w-72 md:w-full bg-white rounded-xl shadow-lg p-6 transition-transform duration-300 hover:scale-105">
                    <div class="flex justify-center mb-2">
                        <div class="bg-blue-100 p-4 rounded-full">
                            <i class="fa-solid fa-shoe-prints text-3xl text-blue-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-gray-800">Sandal</h3>
                    {{-- <p class="text-gray-600 text-center text-sm">Sandal nyaman untuk aktivitas sehari-hari dengan berbagai model terkini.</p> --}}
                    <div class="text-center mt-2">
                        <span class="inline-block bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full">99+ Model</span>
                    </div>
                </div>
                
                <!-- Card Tas -->
                <div class="flex-shrink-0 w-4/5 sm:w-72 md:w-full bg-white rounded-xl shadow-lg p-6 transition-transform duration-300 hover:scale-105">
                    <div class="flex justify-center mb-2">
                        <div class="bg-green-100 p-4 rounded-full">
                            <i class="fa-solid fa-bag-shopping text-3xl text-green-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-gray-800">Tas</h3>
                    {{-- <p class="text-gray-600 text-center text-sm">Koleksi tas stylish dan fungsional untuk menemani penampilan Anda.</p> --}}
                    <div class="text-center mt-2">
                        <span class="inline-block bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full">99+ Variasi</span>
                    </div>
                </div>
                
                <!-- Card Dompet -->
                <div class="flex-shrink-0 w-4/5 sm:w-72 md:w-full bg-white rounded-xl shadow-lg p-6 transition-transform duration-300 hover:scale-105">
                    <div class="flex justify-center mb-4">
                        <div class="bg-amber-100 p-4 rounded-full">
                            <i class="fa-solid fa-wallet text-3xl text-amber-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-gray-800">Dompet</h3>
                    {{-- <p class="text-gray-600 text-center text-sm">Dompet praktis dengan desain modern untuk menyimpan kartu dan uang.</p> --}}
                    <div class="text-center mt-2">
                        <span class="inline-block bg-amber-100 text-amber-600 text-xs px-3 py-1 rounded-full">99+ Tipe</span>
                    </div>
                </div>
                
                <!-- Card Kaus Kaki -->
                <div class="flex-shrink-0 w-4/5 sm:w-72 md:w-full bg-white rounded-xl shadow-lg p-6 transition-transform duration-300 hover:scale-105">
                    <div class="flex justify-center mb-2">
                        <div class="bg-red-100 p-4 rounded-full">
                            <i class="fa-solid fa-socks text-3xl text-red-600"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-gray-800">Kaus Kaki</h3>
                    {{-- <p class="text-gray-600 text-center text-sm">Kaus kaki berkualitas dengan bahan nyaman dan berbagai pilihan motif.</p> --}}
                    <div class="text-center mt-2">
                        <span class="inline-block bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full">99+ Pilihan</span>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('product.catalog') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <span>Lihat Semua Produk</span>
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
</div>
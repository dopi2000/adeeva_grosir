<!-- ==================== SIDEBAR START ==================== -->
<aside id="sidebar" class="fixed md:relative left-0 top-16 md:top-0 w-64 h-[calc(100vh-64px)] md:h-screen transition-transform -translate-x-full md:translate-x-0 bg-white border-r border-gray-200 pt-5 z-10">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('customer.profile') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-user text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Profil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.address') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-map-marker-alt text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Alamat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('change.password.user') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-shield-alt text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Keamanan & Privasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('order.history') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-clipboard-list text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Riwayat Pesanan</span>
                </a>
            </li>
            <li class="pt-5 mt-5 border-t border-gray-200">
                <p class="px-2 text-xs font-semibold text-gray-500 uppercase">Menu Lainnya</p>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-shopping-cart text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Pembelian</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-heart text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Favorit</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-bell text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Notifikasi</span>
                    <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="fas fa-cog text-gray-500 w-5 h-5 transition duration-75"></i>
                    <span class="ms-3">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<!-- ==================== SIDEBAR END ==================== -->
<x-layouts.layout-customer-backend :title="$title" >
{{-- {{ dd($order_history_data) }} --}}
<section class="py-12 relative">
    <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="font-manrope font-extrabold text-3xl lead-10 text-black mb-3">Riwayat Pesanan</h2>

        <div class="flex sm:flex-col lg:flex-row sm:items-center justify-between">
            <ul class="flex max-sm:flex-col sm:items-center gap-x-14 gap-y-3">
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-blue-600 transition-all duration-500 hover:text-blue-600">
                    Semua Pesanan</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-blue-600">
                    Ringkasan</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-blue-600">
                    Selesai</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-blue-600">
                    Dibatalkan</li>
            </ul>
        </div>

        
        @forelse ($order_history_data as $order )
        <div class="mt-7 border border-gray-300 pt-9">
            <div class="flex max-md:flex-col items-center justify-between px-3 md:px-11">
                <div class="data">
                    <p class="font-medium text-lg leading-8 text-black whitespace-nowrap">TRX ID : #{{ $order->trx_id }}</p>
                    <p class="font-medium text-lg leading-8 text-black mt-3 whitespace-nowrap">Tanggal Pesanan : {{ $order->created_at_formatted }}</p>
                </div>
                <div class="flex items-center gap-3 max-md:mt-5">
                    <a href="{{ route('order.confirmed', $order->trx_id) }}"
                        class="rounded-full px-7 py-3 bg-white text-gray-900 border border-gray-300 font-semibold text-sm shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-200 hover:bg-gray-50 hover:border-gray-400">Lihat
                        Faktur</a>
                    <button
                        class="rounded-full px-7 py-3 bg-blue-600 shadow-sm shadow-transparent text-white font-semibold text-sm transition-all duration-500 hover:shadow-blue-400 hover:bg-blue-700">Beli
                        Sekarang</button>

                </div>
            </div>
            <svg class="my-9 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2"
                fill="none">
                <path d="M0 1H1216" stroke="#D1D5DB" />
            </svg>

            @foreach ($order->items as $item )
            <div class="flex max-lg:flex-col items-center gap-8 lg:gap-24 px-3 md:px-11">
                <div class="grid grid-cols-4 w-full">
                    <div class="col-span-4 sm:col-span-1">
                        <a href="{{ route('product.details', $item->slug) }}">
                        <img src="{{ $item->cover_url }}" alt="" class="max-sm:mx-auto object-cover">
                        </a>
                    </div>
                    <div
                        class="col-span-4 sm:col-span-3 max-sm:mt-4 sm:pl-8 flex flex-col justify-center max-sm:items-center">
                        <a href="{{ route('product.details', $item->slug) }}" class="hover:underline">
                            <h6 class="font-manrope font-semibold text-2xl leading-9 text-black mb-3 whitespace-nowrap">{{ $item->name }}</h6>
                        </a>
                        <p class="font-normal text-lg leading-8 text-gray-500 mb-8 whitespace-nowrap">Biaya Pengiriman: {{ $order->shipping_total_formatted }}</p>
                        <div class="flex items-center max-sm:flex-col gap-x-10 gap-y-3">
                            <span class="font-normal text-lg leading-8 text-gray-500 whitespace-nowrap">Qty:
                                {{ $item->quantity }}</span>
                            <p class="font-semibold text-xl leading-8 text-black whitespace-nowrap">Harga {{ $item->price_formatted }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-around w-full  sm:pl-28 lg:pl-0">
                    <div class="flex flex-col justify-center items-start max-sm:items-center">
                        <p class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap">
                            Status</p>
                        @if ($order->status_label === "Selesai")
                            <p class="font-semibold text-lg leading-8 text-green-500 text-left whitespace-nowrap">
                            {{ $order->status_label }}</p>
                            @elseif($order->status_label === "Proses")
                            <p class="font-semibold text-lg leading-8 text-blue-500 text-left whitespace-nowrap">
                            {{ $order->status_label }}</p>
                            @elseif($order->status_label === "Menunggu Pembayaran")
                            <p class="font-semibold text-lg leading-8 text-yellow-500 text-left whitespace-nowrap">
                            {{ $order->status_label }}</p>
                            @else
                            <p class="font-semibold text-lg leading-8 text-red-500 text-left whitespace-nowrap">
                            {{ $order->status_label }}</p>

                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-start max-sm:items-center">
                        <p class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap">
                            Estimasi Pengiriman</p>
                        <p class="font-semibold text-lg leading-8 text-black text-left whitespace-nowrap">{{ $order->shipping->estimated_delivery }}</p>
                    </div>
                </div>

            </div>
            
            <svg class="my-9 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2"
            fill="none">
            <path d="M0 1H1216" stroke="#D1D5DB" />
        </svg>
        @endforeach

            <div class="px-3 md:px-11 flex items-center justify-between max-sm:flex-col-reverse">
                <div class="flex max-sm:flex-col-reverse items-center">
                    <button
                        class="flex items-center gap-3 py-10 pr-8 sm:border-r border-gray-300 font-normal text-xl leading-8 text-gray-500 group transition-all duration-500 hover:text-blue-600">
                        <svg width="40" height="41" viewBox="0 0 40 41" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="stroke-gray-600 transition-all duration-500 group-hover:stroke-blue-600"
                                d="M14.0261 14.7259L25.5755 26.2753M14.0261 26.2753L25.5755 14.7259" stroke=""
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        cancel order
                    </button>
                    <p class="font-normal text-xl leading-8 text-gray-500 sm:pl-8">Payment Is Succesfull</p>
                </div>
                <p class="font-medium text-xl leading-8 text-black max-sm:py-4"> <span class="text-gray-500">Total
                        Harga: </span> {{ $order->total_formatted }}</p>
            </div>
        </div>
        @empty
        <div class="mt-12 flex flex-col items-center justify-center p-10 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50">
            <div class="rounded-full bg-blue-50 p-6 mb-4">
                <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-1">Belum Ada Pesanan</h3>
            <p class="text-gray-500 text-center max-w-xs mb-6">
                Sepertinya Anda belum melakukan transaksi apapun. Mari mulai belanja untuk mengisi riwayat pesanan Anda!
            </p>
            <a href="{{ url('/products') }}" 
               class="rounded-full px-8 py-3 bg-blue-600 text-white font-semibold text-sm transition-all duration-500 hover:bg-blue-700 shadow-lg shadow-blue-200">
               Mulai Belanja
            </a>
        </div>
        @endforelse
    </div>
    <div class="w-full max-w-7xl mx-auto px-4 md:px-8 mt-8"> 
        {{ $order_history_data->onEachSide(1) }}
    </div>
</section>
                                                                      
</x-layouts.layout-customer-backend>
                                            

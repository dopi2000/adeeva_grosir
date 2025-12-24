<div>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang Belanja</h2>
                @if (session('status'))
                <x-customers.frontend.toast-success />
                @endif
                @if (session('error'))
                <x-customers.frontend.toast-error />
                @endif
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @forelse ( $items as $item )
                        <div class="rounded-3xl border-2 border-gray-200 p-4 lg:p-8 grid grid-cols-12 mb-8 max-lg:max-w-lg max-lg:mx-auto gap-y-4 ">
                            <div class="col-span-12 lg:col-span-2 img box">
                                <a href="{{ route('product.details', $item->product()->slug) }}">
                                <img src="{{ $item->product()->cover_url }}" alt="{{ $item->product()->name }}" class="max-lg:w-full lg:w-[180px] rounded-lg object-cover">
                                </a>
                            </div>
                            <div class="col-span-12 lg:col-span-10 detail w-full lg:pl-3">
                                <div class="flex items-center justify-between w-full mb-4">
                                    <a href="{{ route('product.details', $item->product()->slug) }}" class="hover:underline">
                                        <h5 class="font-manrope font-bold text-2xl leading-9 text-gray-900">{{ $item->product()->name }}</h5>
                                    </a>
                                    <livewire:frontend.cart-list-remove :product="$item->product()" :key="$item->sku" />
                                </div>
                                <div class="flex justify-start gap-2 items-center">
                                    <p class="font-normal text-base leading-7 text-gray-500 mb-2">
                                        Kategori:{{ $item->product()->category }}
                                    </p>
                                    <p class="font-normal text-base leading-7 text-gray-500 mb-2">
                                       Stok: {{ $item->product()->stock }}
                                    </p>
                                </div>
                                @error('quantity')
                                <p class="text-xs text-red-500 font-medium mb-4">
                                    {{ $message }}
                                </p>
                                @enderror
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-4">
                                        <button wire:click="decrement('{{ $item->sku }}')"
                                            class="group rounded-[50px] border border-gray-200 shadow-sm shadow-transparent p-2.5 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 hover:bg-primary-600 hover:border-gray-300 focus-within:outline-gray-300">
                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.5 9.5H13.5" stroke="" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <input type="text" id="number-{{ $item->sku }}"
                                            class="border border-gray-200 rounded-full w-10 aspect-square outline-none text-gray-900 font-semibold text-sm py-1.5 px-3 bg-gray-100  text-center read-only:bg-gray-200 disabled:opacity-100" disabled readonly
                                            placeholder="0" value="{{ $item->quantity }}">
                                        <button wire:click="increment('{{ $item->sku }}')"
                                            class="group rounded-[50px] border border-gray-200 shadow-sm shadow-transparent p-2.5 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 hover:bg-primary-600 hover:border-gray-300 focus-within:outline-gray-300">
                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.75 9.5H14.25M9 14.75V4.25" stroke="" stroke-width="1.6"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <div class="text-lg font-medium text-gray-900">
                                            <i class="fa-solid fa-multiply"></i>
                                        </div>
                                        <h6 class="text-gray-900 font-manrope font-bold text-lg leading-9 text-right">{{ number_format($item->price) }}</h6>
                                    </div>

                                    <h6 class="text-primary-600 font-manrope font-bold text-lg leading-9 text-right">{{ Number::currency($item->price * $item->quantity) }}</h6>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="flex items-center justify-center min-h-screen p-2 sm:p-3">
                            <div class="bg-white   p-4 max-w-sm w-full text-center ">
                                <div class="relative mb-6">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-full h-px bg-blue-200 transform -translate-y-4"></div>
                                        <div class="w-1/2 h-px bg-blue-200 absolute left-1/4 top-1/2 transform translate-y-2"></div>
                                        <div class="w-1/4 h-px bg-blue-200 absolute right-1/4 bottom-1/4"></div>
                                    </div>
                                    <svg class="w-24 h-24 mx-auto text-blue-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-4 h-4 border-l-2 border-r-2 border-blue-500 rotate-45"></div>
                                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-8 h-px bg-blue-200 -mt-2"></div>
                                </div>

                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">
                                    Keranjang Belanja Anda Kosong
                                </h2>
                                <p class="text-sm text-gray-500 mb-8">
                                    Lihat apa yang sedang laris
                                </p>

                                <a href="/products" class="inline-block w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-150 ease-in-out">
                                    Temukan Produk
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan pesanan</p>

                    <div class="space-y-4">
                        <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Sub Total</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $sub_total }}</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pengiriman</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">0</dd>
                        </dl>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="text-base font-bold text-gray-900 dark:text-white">{{ $total }}</dd>
                        </dl>
                    </div>

                    <button wire:click="checkout" wire:loading.attr="disabled" type="button" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <span wire:loading.remove wire:target="checkout">Lanjutkan ke Pembayaran</span>
                        <div wire:loading wire:target="checkout" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white-600 rounded-full dark:text-white-500" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>

                    <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> atau </span>
                        <a href="/products"  class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                        Lanjutkan Berbelanja
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                        </a>
                    </div>
                    </div>

                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <form class="space-y-4">
                        <div>
                        <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Apakah Anda punya voucher atau kartu hadiah?</label>
                        <input type="text" id="voucher" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Gunakan voucher atau kode promo" required />
                        </div>
                        <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Gunakan Kode</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

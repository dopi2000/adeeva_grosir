<div>
    
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        {{-- <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
            <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Keranjang
                </span>
            </li>

            <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Pembayaran
                </span>
            </li>

            <li class="flex shrink-0 items-center">
                <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Ringkasan Pesanan
            </li>
        </ol> --}}

        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
        <div class="min-w-0 flex-1 space-y-8">
            <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Detail Alamat Tujuan Pengiriman</h2>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="your_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nama </label>
                    <input wire:model="data.name" type="text" id="your_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"  required disabled />
                </div>


                <div>
                    <label for="phone" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nomor HP </label>
                    <input wire:model="data.phone" type="tel" id="phone" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"  required disabled />
                </div>

                <div>
                    <label for="street_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nama Jalan </label>
                    <input wire:model="data.street_name" type="text" id="street_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required disabled />
                </div>



                <div>
                    <label for="province" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Provinsi </label>
                    <input wire:model="data.province" type="text" id="province" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required readonly disabled/>
                </div>

                <div>
                    <label for="city" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Kota/Kabupaten </label>
                    <input wire:model="data.city" type="text" id="city" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"  required readonly disabled/>
                </div>

                <div>
                    <label for="district" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Kecamatan </label>
                    <input wire:model="data.district" type="text" id="district" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required disabled readonly />
                </div>

                <div>
                    <label for="village" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Desa/Kelurahan </label>
                    <input wire:model="data.village" type="text" id="village" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required disabled readonly />
                </div>

                <div>
                    <label for="postal_code" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Kode Pos </label>
                    <input wire:model="data.postal_code" type="text" id="postal_code" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required disabled readonly />
                </div>
            </div>
            </div>

            <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Pilih Metode Pembayaran</h3>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                    <input id="credit-card" aria-describedby="credit-card-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" checked />
                    </div>

                    <div class="ms-4 text-sm">
                    <label for="credit-card" class="font-medium leading-none text-gray-900 dark:text-white"> Credit Card </label>
                    <p id="credit-card-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Pay with your credit card</p>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Delete</button>

                    <div class="h-3 w-px shrink-0 bg-gray-200 dark:bg-gray-700"></div>

                    <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Edit</button>
                </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                    <input id="pay-on-delivery" aria-describedby="pay-on-delivery-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                    </div>

                    <div class="ms-4 text-sm">
                    <label for="pay-on-delivery" class="font-medium leading-none text-gray-900 dark:text-white"> Payment on delivery </label>
                    <p id="pay-on-delivery-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">+$15 payment processing fee</p>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Delete</button>

                    <div class="h-3 w-px shrink-0 bg-gray-200 dark:bg-gray-700"></div>

                    <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Edit</button>
                </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                    <input id="paypal-2" aria-describedby="paypal-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                    </div>

                    <div class="ms-4 text-sm">
                    <label for="paypal-2" class="font-medium leading-none text-gray-900 dark:text-white"> Paypal account </label>
                    <p id="paypal-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Connect to your account</p>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Delete</button>

                    <div class="h-3 w-px shrink-0 bg-gray-200 dark:bg-gray-700"></div>

                    <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Edit</button>
                </div>
                </div>
            </div>
            </div>

            <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Pilih Metode Pengiriman</h3>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ($this->shipping_methods as $group_name => $shipping_method_groups)
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                    <span class="text-xs mb-1 mr-2">{{ $group_name }}</span>
                    @foreach ($shipping_method_groups as $i => $shipping)
                    <div class="flex items-start">
                        <div class="flex h-5 items-center">
                        <input wire:key="{{ $shipping->hash }}" wire:model.live="shipping_selector.shipping_method" id="{{ $shipping->hash }}" aria-describedby="dhl-text" type="radio" name="delivery-method" value="{{ $shipping->hash }}" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 " checked />
                        </div>

                        <div class="ms-4 text-sm">
                            <label for="$shipping->hash" class="font-medium leading-none text-gray-900 dark:text-white">{{ $shipping->label  }} / {{  $shipping->cost_formatted }}</label>
                            <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500">Estimasi: {{ $shipping->estimated_delivery }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            </div>

            <div>
            <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Enter a gift card, voucher or promotional code </label>
            <div class="flex max-w-md items-center gap-4">
                <input type="text" id="voucher" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="" required />
                <button type="button" class="flex items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply</button>
            </div>
            </div>
        </div>

        <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
            <div class="flow-root">
            <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Sub Total</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">{{ data_get($summaries, 'sub_total_formatted') }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Potongan Harga</dt>
                <dd class="text-base font-medium text-green-500">0</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Pengiriman</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">{{ data_get($summaries, 'shipping_total_formatted') }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pajak</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">0</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white">{{ data_get($summaries, 'grant_total_formatted') }}</dd>
                </dl>
            </div>
            </div>

            <div class="space-y-3">
            <button wire:click="placeAnOrder()" type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proses Pembayaran</button>

            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">One or more items in your cart require an account. <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Sign in or create an account now.</a>.</p>
            </div>
        </div>
        </div>
    </form>
    </section>
</div>

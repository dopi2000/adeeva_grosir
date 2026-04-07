<section class="bg-white py-8 antialiased md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 sm:text-base">
      <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200  sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
        <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/']  sm:after:hidden">
          <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Keranjang
        </span>
      </li>
      <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 :text-primary-500  sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
        <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] sm:after:hidden">
          <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Checkout
        </span>
      </li>

      <li class="flex shrink-0 items-center">
        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        Ringkasan pesanan
      </li>
    </ol>

    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
      <div class="min-w-0 flex-1 space-y-8">
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900">Detail Pengiriman</h2>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label for="name" class="mb-2 block text-sm font-medium text-gray-900"> Nama Anda </label>
              <input wire:model="data.name" type="text" id="name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly/>
            </div>

            <div>
              <label for="email" class="mb-2 block text-sm font-medium text-gray-900"> Email Anda </label>
              <input wire:model="data.email" type="email" id="email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly />
            </div>

                        <div>
              <label for="phone-input-3" class="mb-2 block text-sm font-medium text-gray-900"> Nomor Kontak </label>
              <div class="flex items-center">
                <button id="dropdown-phone-button-3" class="z-10 inline-flex shrink-0 items-center rounded-s-lg border border-gray-300 bg-gray-100 px-4 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100" type="button">
                    <svg fill="none" aria-hidden="true" class="me-2 h-4 w-4" viewBox="0 0 20 15">
                    <mask id="round-corner" fill="white">
                        <rect width="20" height="15" rx="2" />
                    </mask>
                    <g mask="url(#round-corner)">
                        <rect width="20" height="15" fill="#fff" />
                        <rect width="20" height="7.5" fill="#E02020" />
                    </g>
                    </svg>
                    +62
                    <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <div class="relative w-full">
                  <input wire:model="data.phone" type="text" id="phone-input" class="z-20 block w-full rounded-e-lg border border-s-0 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" readonly />
                </div>
              </div>
            </div>

            <div>
                <div>
                    <label for="province" class="mb-2 block text-sm font-medium text-gray-900"> Provinsi </label>
                    <input wire:model="data.province" type="province" id="province" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-blue-500" readonly />
                </div>
            </div>

            <div>
                <div>
                    <label for="regency" class="mb-2 block text-sm font-medium text-gray-900"> Kota/Kabupaten </label>
                    <input wire:model="data.regency" type="text" id="regency" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly/>
                </div>
            </div>

            <div>
              <label for="district" class="mb-2 block text-sm font-medium text-gray-900"> Kecamatan </label>
              <input wire:model="data.district" type="text" id="district" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly/>
            </div>

            <div>
              <label for="village" class="mb-2 block text-sm font-medium text-gray-900"> Desa / Kelurahan </label>
              <input wire:model="data.village" type="text" id="village" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly />
            </div>

            <div>
              <label for="postal_code" class="mb-2 block text-sm font-medium text-gray-900"> Kode  Pos</label>
              <input wire:model="data.postal_code" type="text" id="postal_code" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly />
            </div>

            <div class="sm:col-span-2">
              <label for="postal_code" class="mb-2 block text-sm font-medium text-gray-900"> Detail Alamat Spesifik</label>
              <input wire:model="data.street_name" type="text" id="postal_code" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" readonly />
            </div>
          </div>
        </div>

        <div class="space-y-4">
          <h3 class="text-xl font-semibold text-gray-900">Pilih Metode Pengiriman</h3>
          @error('data.shipping_hash')
          <div class="p-4 mb-4 text-sm text-red-600 rounded-base bg-red-100" role="alert">
            <span class="font-medium">{{ $message }}</span>
          </div>
          @enderror
          @foreach ($this->shipping_methods as $group_name => $shipping_method )
          <span class="my-4 text-blue-600 font-medium text-md">{{ $group_name }}</span>
          <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($shipping_method as $shipping)
             @php
                 $isCod = str_contains(strtoupper($shipping->label), 'CASH ON DELIVERY');
                 $isNotTernate = $shipping->destination->city !== "Kota Ternate";
                 $isDisabled = $isCod && $isNotTernate;
             @endphp
                <div class="rounded-lg border border-gray-200 {{ $isDisabled ? 'bg-gray-200 opacity-60' : 'bg-gray-50' }} p-4 ps-4 ">
                    <div class="flex items-start ">
                        <div class="flex h-5 items-center">
                        <input wire:model.live.debounce.250="shipping_selector.shipping_method" wire:key="{{ $shipping->hash }}" id="{{ $shipping->hash }}" type="radio" value="{{ $shipping->hash }}" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600  {{ $isDisabled ? 'hover:cursor-not-allowed' : 'hover:cursor-pointer' }}" {{ $isDisabled ? 'disabled' : '' }} checked />
                        </div>

                        <div class="ms-4 text-sm">
                        <label for="{{ $shipping->hash }}" class="font-medium leading-none text-gray-900 {{ $isDisabled ? 'hover:cursor-not-allowed' : 'hover:cursor-pointer' }}"> {{ $shipping->label }} - {{ $shipping->cost_formatted }}
                        <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500">Estimasi: {{ $shipping->estimated_delivery }}</p>
                        <p id="dhl-text" class="mt-1 text-xs font-normal text-gray-500">{{ $shipping->description }}</p>
                        </label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
          @endforeach
        </div>

        <div class="space-y-4">
          <h3 class="text-xl font-semibold text-gray-900">Pilih Metode Pembayaran</h3>
          @error('data.payment_hash')
            <div class="p-4 mb-4 text-sm text-red-600 rounded-base bg-red-100" role="alert">
              <span class="font-medium">{{ $message }}</span>
            </div>
          @enderror          
          <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($this->payment_methods->toCollection() as $key =>$payment )
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input wire:model.live="payment_method_selector.payment_method_selected" wire:key="payment_method-{{ $payment->hash }}" id="payment-method-{{ $payment->hash }}" type="radio" value="{{ $payment->hash }}" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600" checked />
                </div>

                <div class="ms-4 text-sm">
                  <label for="payment-method-{{ $payment->hash }}" class="font-medium leading-none text-gray-900"> {{ $payment->label }} </label>
                  <p id="credit-card-text" class="mt-1 text-xs font-normal text-gray-500"></p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div>
          <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900"> Masukkan kartu hadiah, voucher, atau kode promo.</label>
          <div class="flex max-w-md items-center gap-4">
            <input type="text" id="voucher" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="Input Voucher Diskon"  />
            <button type="button" class="flex items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Terapkan</button>
          </div>
        </div>
      </div>

      <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
        <div class="flow-root">
          <div class="-my-3 divide-y divide-gray-200">
            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500">Subtotal</dt>
              <dd class="text-base font-medium text-gray-900">{{ data_get($this->summaries, 'sub_total_formatted') }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500">Potongan Harga</dt>
              <dd class="text-base font-medium text-green-500">0</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500">Biaya Pengiriman</dt>
              <dd class="text-base font-medium text-gray-900">{{ data_get($this->summaries, 'shipping_total_formatted') }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500">Pajak</dt>
              <dd class="text-base font-medium text-gray-900">0</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-bold text-gray-900">Total</dt>
              <dd class="text-base font-bold text-gray-900">{{ data_get($this->summaries, 'grant_total_formatted') }}</dd>
            </dl>
          </div>
        </div>

        <div class="space-y-3">
          <button wire:click="placeAnOrder" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300">
          <span wire:loading.remove wire:target="placeAnOrder">Bayar Sekarang</span>
          <div wire:loading.attr="disable" wire:loading wire:target="placeAnOrder" role="status">
              <svg aria-hidden="true" class="inline w-4 h-4 w-4 h-4 text-neutral-tertiary animate-spin fill-brand" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                  <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
              </svg>
              <span class="sr-only">Loading...</span>
          </div>
          </button>

          <p class="text-sm font-normal text-gray-500">Satu atau lebih item dalam keranjang belanja Anda memerlukan akun. <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline">Masuk atau buat akun sekarang.</a>.</p>
        </div>
      </div>
    </div>
  </div>
</section>
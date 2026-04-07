<div>
    @if (session('success'))
    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div class="ms-3 text-sm font-medium">
        {{ session('success') }}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
    </div>
    @endif
    <h2 class="mb-4 text-xl  font-bold text-gray-900 dark:text-white">Informasi Alamat Saya</h2>
    <form wire:submit.prevent="updateAdress">
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
                <span class="text-sm py-2 text-blue-700">Note: Mohon berikan detail alamat Anda, guna untuk memudahkan proses pengiriman</span>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail Alamat</label>
                <input wire:model.live.debounce.250ms="street_name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan nama jalan anda" autofocus>
                @error('street_name')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Provinsi</label>
                <select wire:model.live="province" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinces as $key => $province )
                    <option value="{{ $key }}">{{ $province }}</option>
                    @endforeach
                </select>
                @error('province')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota/Kab.</label>
                  <select wire:model.live="regency"  id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Kota/Kabupaten</option>
                    @if (is_array($regencies) && !empty($regencies))
                    @foreach ($regencies as $key => $regency )
                    <option value="{{ $key }}">{{ $regency }}</option>
                    @endforeach   
                    @endif
                </select>
                @error('regency')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label for="district" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                <select wire:model.live="district" id="district" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Kecamatan</option>
                    @if (is_array($districts) && !empty($districts))
                    @foreach ($districts as $key => $district )
                    <option value="{{ $key }}">{{ $district }}</option>
                    @endforeach
                    @endif
                </select>
                @error('district')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div> 
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="village">Desa/Kel.</label>
                <select wire:model.live="village" id="village" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Desa/Kelurahan</option>
                    @if (is_array($villages) && !empty($villages))
                    @foreach ($villages as $key => $village )
                    <option value="{{ $key }}">{{ $village }}</option>
                    @endforeach
                    @endif
                </select>
                @error('village')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label for="postal_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Kode Pos</label>
                <input wire:model="postal_code" type="text" id="postal_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Kode Pos" readonly disabled>
                @error('postal_code')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <button wire:click.prevent="updateAddress" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <span wire:loading.remove wire:target="updateAddress">Simpan</span>
                    <div wire:loading wire:target="updateAddress" role="status">
                        <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
    </form> 
</div>

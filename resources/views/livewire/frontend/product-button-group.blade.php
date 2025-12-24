<div>
    @error('quantity')
        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
    @enderror
     <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 py-8">
            <div class="flex sm:items-center sm:justify-center w-full">
                <button wire:click="decrement()"
                    class="group py-4 px-6 border border-gray-400 rounded-l-full bg-white transition-all duration-300 hover:bg-primary-600 hover:text-white hover:shadow-sm hover:shadow-gray-300">
                    <svg class="stroke-gray-900 hover:text-white group-hover:stroke-black" width="22" height="22"
                        viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                        <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                            stroke-linecap="round" />
                        <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                            stroke-linecap="round" />
                    </svg>
                </button>
                <input wire:model="quantity" name="quantity" type="number"
                    class="font-semibold text-gray-900 cursor-pointer text-lg py-[13px] px-6 w-full sm:max-w-[118px] outline-0 border-y border-gray-400 bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50"
                    placeholder="0" disabled readonly>
                    <button wire:click="increment()"
                    class="group py-4 px-6 border border-gray-400 rounded-r-full bg-white transition-all duration-300 hover:bg-primary-600 hover:text-white hover:shadow-sm hover:shadow-gray-300">
                    <svg class="stroke-gray-900 hover:text-white  group-hover:stroke-black" width="22" height="22"
                    viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="#9CA3AF" stroke-width="1.6"
                    stroke-linecap="round" />
                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2"
                    stroke-width="1.6" stroke-linecap="round" />
                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2"
                    stroke-width="1.6" stroke-linecap="round" />
                </svg>
            </button>
        </div>
            <button wire:click="addToCart()"
                class="group py-4 px-5 rounded-full bg-primary-50 text-primary-600 font-semibold text-lg w-full flex items-center justify-center gap-2 transition-all duration-500 hover:bg-primary-100">
                <svg wire:loading.remove wire:target="addToCart" class="stroke-primary-600 " width="22" height="22" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.7394 17.875C10.7394 18.6344 10.1062 19.25 9.32511 19.25C8.54402 19.25 7.91083 18.6344 7.91083 17.875M16.3965 17.875C16.3965 18.6344 15.7633 19.25 14.9823 19.25C14.2012 19.25 13.568 18.6344 13.568 17.875M4.1394 5.5L5.46568 12.5908C5.73339 14.0221 5.86724 14.7377 6.37649 15.1605C6.88573 15.5833 7.61377 15.5833 9.06984 15.5833H15.2379C16.6941 15.5833 17.4222 15.5833 17.9314 15.1605C18.4407 14.7376 18.5745 14.0219 18.8421 12.5906L19.3564 9.84059C19.7324 7.82973 19.9203 6.8243 19.3705 6.16215C18.8207 5.5 17.7979 5.5 15.7522 5.5H4.1394ZM4.1394 5.5L3.66797 2.75"
                        stroke="" stroke-width="1.6" stroke-linecap="round" />
                </svg>
                <span wire:loading.remove wire:target="addToCart">Keranjang Belanja</span>
                <div wire:loading wire:target="addToCart" role="status">
                    <svg aria-hidden="true" class="inline w-6 h-6 text-blue-600 animate-spin dark:text-gray-600 fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </div>
        <div class="flex items-center gap-3">
            <button
                class="group transition-all duration-500 p-4 rounded-full bg-primary-50 hover:bg-primary-100 hover:shadow-sm hover:shadow-primary-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                    fill="none">
                    <path
                        d="M4.47084 14.3196L13.0281 22.7501L21.9599 13.9506M13.0034 5.07888C15.4786 2.64037 19.5008 2.64037 21.976 5.07888C24.4511 7.5254 24.4511 11.4799 21.9841 13.9265M12.9956 5.07888C10.5204 2.64037 6.49824 2.64037 4.02307 5.07888C1.54789 7.51738 1.54789 11.4799 4.02307 13.9184M4.02307 13.9184L4.04407 13.939M4.02307 13.9184L4.46274 14.3115"
                        stroke="#4F46E5" stroke-width="1.6" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </button>
            <button
                class="text-center w-full px-5 py-4 rounded-[100px] bg-primary-600 flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-primary-700 hover:shadow-primary-400">
                Beli Sekarang
            </button>
        </div>
</div>

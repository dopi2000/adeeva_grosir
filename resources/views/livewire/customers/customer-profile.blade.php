@push('styles')
     <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
     <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
@endpush
<div>
    @if (session('success'))
    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div class="ms-3 text-sm font-medium">
        {{ session('success') }}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
    </div>
    @endif
    <h2 class="mb-4 text-xl font-bold text-gray-900">Informasi profile saya</h2>
    <form wire:submit.prevent="updateProfileCustomer">
        <input wire:model="avatar" type="hidden" id="avatarPath">
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 @error('name') text-red-600 @enderror">Nama Lengkap</label>
                <input wire:model="name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 @enderror" value="{{ $name }}" placeholder="Masukan nama lengkap anda" autofocus>
                @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 @error('username') text-red-600 @enderror">Nama Pengguna</label>
                <input wire:model="username" type="text" name="username" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  @error('username') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 @enderror" value="{{ $username }}" placeholder="Masukan nama pengguna anda">
                @error('username')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 @error('email') text-red-600 @enderror">Email</label>
                <input wire:model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  @error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 @enderror" value="{{ $email }}" placeholder="Masukan email anda">
                @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 @error('phone') text-red-600 @enderror">Nomor Handphone</label>
                <input wire:model="phone" type="text" inputmode="numeric" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  @error('phone') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 @enderror" value="{{ $phone }}" placeholder="Masukan nomor handphone anda">
                @error('phone')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div> 
            {{-- area profile image --}}
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="avatar">Unggah avatar</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="user_avatar_help" id="avatar" name="avatar" type="file">
                <div class="mt-1 text-sm text-gray-500" id="user_avatar_help">Foto profil berguna untuk memastikan anda sudah masuk ke akun Anda.</div>
            </div>
            <div class="w-full">
                <label for="preview" class="block mb-2 text-sm font-medium text-gray-900">Gambar Profile</label>
                <div class="flex items-center justify-center w-full h-5">
                    <div class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 ">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="w-32 h-32 mb-4 rounded-lg flex items-center justify-center">
                                <!-- Preview image container -->
                                @if (Auth::user()->avatar)
                                <img class="h-33 w-33 rounded-lg shadow-sm" src="{{ asset("storage/" . Auth::user()->avatar) }}" alt="image description">
                                @else
                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                @endif
                            </div>
                            <p class="mb-2 text-sm text-gray-500">Avatar profil</p>
                            <p class="text-xs text-gray-500">Dimensi gambar 500 x 500</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- area profile image --}}
            <div class="sm:col-span-2 space-x-4">
                <button wire:click.prevent="updateProfileCustomer" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <span wire:loading.remove>Update Profile</span>
                    <div wire:loading wire:target="updateProfileCustomer" role="status">
                        <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>   
</div>

@push('scripts')
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script>
            // Panggil fungsi inisialisasi dan berikan objek @this
            document.addEventListener('livewire:initialized', () => {
                initFilePond();
            });
 
            // Panggil ulang inisialisasi saat navigasi Livewire
            document.addEventListener('livewire:navigated', () => {
                initFilePond();
            });
           function initFilePond() {
                    FilePond.registerPlugin(FilePondPluginImagePreview);
                    FilePond.registerPlugin(FilePondPluginFileValidateType);
                    FilePond.registerPlugin(FilePondPluginFileValidateSize);
                    FilePond.registerPlugin(FilePondPluginImageResize);

                    const inputElement = document.querySelector('#avatar');
                    const hiddenInput = document.querySelector('#avatarPath');
                    if (inputElement && !FilePond.find(inputElement)) {
                        const pond = FilePond.create(inputElement, {
                            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
                            labelFileTypeNotAllowed: 'File yang di unggah tidak valid',
                            fileValidateTypeLabelExpectedTypes: 'Format valid {allButLastType} atau {lastType}',
                            fileValidateTypeLabelExpectedTypesMap:{
                                'image/png': '.png',
                                'image/jpg': '.jpg',
                                'image/jpeg': '.jpeg',
                            },
                            maxFileSize:'1MB',
                            labelMaxFileSizeExceeded:'File avatar terlalu besar',
                            labelMaxFileSize:'Ukuran file maksimum adalah {filesize}',
                            imageResizeTargetWidth: '600',
                            imageResizeMode: 'contain',
                            imageResizeUpscale:false,
                            server: {
                                headers: {
                                    'X-CSRF-TOKEN':  '{{ csrf_token() }}' 
                                },
                                process: {
                                    url: '/upload-avatar',
                                    onload: (response) => {
                                        hiddenInput.value = response;
                                        hiddenInput.dispatchEvent(new Event('input'));
                                        return response;
                                    },
                                },
                                revert: {
                                    url:'/cancel-upload-avatar',
                                    onload:(response) => {
                                        hiddenInput.value = response;
                                        hiddenInput.dispatchEvent(new Event('input'));
                                    }
                                },
                                fetch: null,
                            }
    
    
                        }); 
                    } //pengkondisian
        } //function inisialiassi
        </script>
@endpush



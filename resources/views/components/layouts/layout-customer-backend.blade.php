<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>{{ $title ?? 'Adeeva Grosir' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        {{-- stacks for style css --}}
        @stack('styles')
    </head>
    <body class="bg-gray-50">
        <div class="flex flex-col md:flex-row">
            {{-- navbar --}}
            <x-customers.backend.dashboard-customer-navbar/>
            
            <div class="flex flex-1 pt-16">
                {{-- sidebar --}}
                <x-customers.backend.dashboard-customer-sidebar/>
                {{-- main content --}}
                <main class="flex-1 min-w-0 bg-gray-50 flex justify-center">
                    <div class="mx-auto">
                        <div class="w-full max-w-5xl py-6 px-4 sm:px-6 md:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
            
            
        </div>
        
        
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <script src="{{ asset('js/backend/sidebar.js') }}"></script>
     @stack('scripts')
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>{{ $title ?? 'Adeeva Grosir' }}</title>
        @vite('resources/css/app.css')

        {{-- stacks for style css --}}
        @stack('styles')
    </head>
    <body>
        <x-customers.backend.dashboard-customer-navbar/>
        <main class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            {{ $slot }}
        </main>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
     @stack('scripts')
    </body>
</html>
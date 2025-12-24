@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
@endpush
<x-layouts.layout-customer :title="$title"> 
    <livewire:frontend.product-catalog />
</x-layouts.layout-customer>

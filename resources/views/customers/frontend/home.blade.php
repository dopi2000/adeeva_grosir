@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
@endpush
<x-layouts.layout-customer :title="$title" >
    {{-- hero section CTA or Landing Page --}}
    <section class="mt-7 md:px-5 lg:px-10 xl:px-20">
       <x-customers.frontend.hero-section />
    </section>
    {{-- hero section CTA or Landing Page --}}

    {{-- bagian kategori produk --}}
    <section class="mt-10 py-12 px-4 md:px-5 lg:px-14 xl:px-20">
       <x-customers.frontend.category-list-section />
    </section>
     {{-- bagian kategori produk --}}

     {{-- product card list  --}}
     <section class="mb-4 py-12 px-4 md:px-5 lg:px-14 xl:px-20">
           <x-customers.frontend.product-recomended-section />
     </section>
     {{-- prduct card list  --}}
</x-layouts.layout-customer>


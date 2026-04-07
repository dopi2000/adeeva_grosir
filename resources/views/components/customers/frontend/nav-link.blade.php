@props(['href', 'current' => false, 'ariaCurrent' => false])

@php
    if($current) {
        $classes = 'text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 ';
        $ariaCurrent = 'page';
    } else {

        $classes = 'text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-70';
    }
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "block py-2 pr-4 pl-3 lg:p-0 " . $classes, 'aria-current' => $ariaCurrent]) }}>{{ $slot }}</a>

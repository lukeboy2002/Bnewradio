@props(['active' => false])

@php
    $classes = 'flex items-center text-gray-500 border-transparent rounded-lg px-5 py-2 text-sm font-semibold uppercase hover:bg-red-100 hover:text-red-700 focus:outline-none focus:bg-red-100 focus:text-red-700 ';
    if ($active) $classes .= 'bg-red-100';
@endphp

<a {{ $attributes (['class' => $classes]) }}>
    {{ $slot }}
</a>



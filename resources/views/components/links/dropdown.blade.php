@props(['active' => false])

@php
    $classes = 'flex items-center text-gray-500 px-3 py-2 text-sm font-semibold hover:text-red-700 hover:bg-red-100 focus:outline-none focus:text-red-700';
    if ($active) $classes .= ' text-red-700 bg-red-100';
@endphp

<a {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</a>



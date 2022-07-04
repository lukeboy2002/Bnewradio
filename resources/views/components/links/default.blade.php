@php
    $classes = 'inline-flex items-center px-2 py-1 text-xs font-medium hover:underline focus:outline-none hover:underline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

@props(['name'])

@php
    $classes = 'pt-2 text-red-500 italic text-xs';
@endphp

@error($name)
    <p {{ $attributes->merge(['class' => $classes]) }}>{{ $message }}</p>
@enderror

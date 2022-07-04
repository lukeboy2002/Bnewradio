@props(['name'])
@php
    $classes = 'block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm';
@endphp

<x-form.field>
    <x-form.label name="{{ $name }}" />

    <input {{ $attributes->merge(['class' => $classes]) }}
           name="{{ $name }}"
           id="{{ $name }}"
           aria-label="{{ $name }}"
           {{ $attributes(['value' => old($name)]) }}
    />
    <x-form.error name="{{ $name }}" />
</x-form.field>





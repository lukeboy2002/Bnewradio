<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles />

</head>

@props(['header'])

<body class="antialiased relative h-full">
<div class="min-h-full">
{{--    <x-menus.top />--}}
    <x-messages />

    <main>
        <div class="w-full mx-auto ">
            {{ $slot }}
        </div>
    </main>
</div>

{{--<x-footer />--}}

<!-- Scripts -->
<livewire:scripts />
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

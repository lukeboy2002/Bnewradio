@props([
    'header',
])

<div class="space-y-6">
    <div class="bg-white shadow sm:rounded-lg p-4 sm:mx-auto sm:w-full sm:max-w-md">
        @if (isset($header) && $header != null )
            <h2 class="mt-6 text-center text-3xl font-extrabold text-red-700">
                {{ $header }}
            </h2>
        @endif
        {{ $slot }}
    </div>
</div>


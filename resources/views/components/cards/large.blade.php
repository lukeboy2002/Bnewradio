@props([
    'header',
])
<div class="space-y-6">
    <div class="bg-white shadow sm:rounded-lg p-4">
        @if (isset($header) && $header != null )
            <div class="pb-4 ">
                {{ $header }}
            </div>
        @endif
        {{ $slot }}
    </div>
</div>

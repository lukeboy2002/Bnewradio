@props(['trigger'])

<div x-data="{ show: false }" @keydown.escape="show = false" @click.away="show = false" class="relative inline-block text-left">
    {{-- Trigger --}}

    <div @click="show = !show">
        {{ $trigger }}
    </div>

    {{-- Links --}}
    <div x-show="show"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-300 transform"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="origin-top-right absolute z-50 right-0 mt-2 w-56 max-h-52 overflow-auto rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="menu-button"
         tabindex="-1"
         style="display: none"
    >
        <div class="py-1" role="none">
            {{ $slot }}
        </div>
    </div>
</div>

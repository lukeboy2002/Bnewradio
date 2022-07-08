<div class="px-2 pt-2 pb-2 sm:px-3">
    <x-menus.main />
</div>
@guest
    <div class="pt-2 pb-2 border-t border-gray-300">
        @if (Route::has('login'))
            <div class="px-2 sm:px-3">
                <x-links.main href="{{ route('login') }}" :active="request()->routeIs('login')">Login</x-links.main>
                @if (Route::has('register'))
                    <x-links.main href="{{ route('register') }}" :active="request()->routeIs('register')">Register</x-links.main>
                @endif
            </div>
        @endif
    </div>
@endguest

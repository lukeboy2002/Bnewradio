<nav x-data="{ isOpen: false }" @keydown.escape="isOpen = false" class="bg-white" >
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex justify-between h-20">
            @auth
                <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                    <x-buttons.usericon />
                </div>
            @endauth
            <div class="flex-1 flex items-center justify-center md:items-stretch md:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <div class="block md:hidden">
                        <x-logo />
                    </div>
                    <div class="hidden md:block">
                        <x-logo />
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center space-x-2">
                    <x-menus.main />
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <!-- Profile and live -->
                <div class="hidden md:ml-6 md:flex md:items-center">
{{--                    <x-playicon />--}}
                @if (Route::has('login'))
                    @auth
                        <!-- Profile dropdown -->
                            <div class="ml-3 text-red-700 text-sm font-bold">
                                <span class="sr-only">Open user menu for </span>
                                {{ current_user()->username }}
                            </div>
                            <x-menus.profile-dropdown>

                                <x-slot name="trigger">
                                    <button type="button" class="ml-3 bg-white rounded-full flex text-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                        <img class="h-8 w-8 rounded-full" src="{{asset('storage/'.current_user()->avatar)}}" alt="Avatar">
                                    </button>
                                </x-slot>
                                <x-links.dropdown href="{{ route('profiles', current_user()->username) }}" :active="request()->routeIs('profile')">Your Profile</x-links.dropdown>
{{--                                <x-link.dropdown href="{{ route('profiles.edit', current_user()->username) }}" :active="request()->routeIs('profiles.edit')">Settings</x-link.dropdown>--}}
                                <x-links.dropdown href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</x-links.dropdown>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </x-menus.profile-dropdown>
                        @else
                            <div class="px-2 sm:px-3 sm:flex space-x-2">
                                <x-links.main href="{{ route('login') }}" :active="request()->routeIs('login')"><i class="fas fa-sign-in-alt mr-2"></i>Login</x-links.main>
                                @if (Route::has('register'))
                                    <x-links.main href="{{ route('register') }}" :active="request()->routeIs('register')"><i class="fas fa-user-plus mr-2"></i>Register</x-links.main>
                                @endif
                            </div>
                        @endauth
                    @endif
                </div>
                <!-- Profile and live -->
                <!-- Menu button -->
                    <x-buttons.hamburger />
                <!-- Menu button -->
            </div>
        </div>
    </div>
    <!-- Mobile menu -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu" style="display: none">
        <x-menus.mobile />
    </div>
</nav>





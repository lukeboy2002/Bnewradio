@auth
<div x-data="{ isUserMenu: false }" @keydown.escape="isUserMenu = false" class="relative">
    <button type="button" @click="isUserMenu = !isUserMenu" @click.away="isUserMenu = false" class="mr-3 bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700">
        <img class="h-8 w-8 rounded-full" src="{{ current_user()->avatar }}" alt="Avatar">
    </button>

    <x-menus.usersmenu />
</div>
@endauth

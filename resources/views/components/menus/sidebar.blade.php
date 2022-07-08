@role('Admin')
    <x-links.main href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.user*')">
        <i class="fas fa-users mr-2"></i>All users
    </x-links.main>

    <x-links.main href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles*')">
        <i class="fa-solid fa-folder-open mr-2"></i>Roles
    </x-links.main>

    <x-links.main href="{{ route('admin.permissions.index') }}" :active="request()->routeIs('admin.permissions*')">
        <i class="fa-solid fa-clipboard-list mr-2"></i>Permissions
    </x-links.main>

@endrole



    <div class="relative pb-2">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
    </div>

    <x-links.main href="{{ route('home') }}" :active="request()->routeIs('home')">
        <i class="fas fa-home mr-2"></i>Home
    </x-menu.links.main>

{{--    <x-links.main href="{{ route('tweet') }}" :active="request()->routeIs('tweet')">--}}
{{--        <i class="far fa-comment-dots mr-2"></i>Tweets--}}
{{--    </x-menu.links.main>--}}


{{--    <x-links.main href="{{ route('explore') }}" :active="request()->routeIs('explore*')">--}}
{{--        <i class="fas fa-globe-europe mr-2"></i>Explore--}}
{{--    </x-links.main>--}}

    <x-links.main href="#">
        <i class="far fa-bell mr-2"></i>Notifications
    </x-links.main>

    <x-links.main href="#">
        <i class="far fa-comment mr-2"></i>Messages
    </x-links.main>

    <x-links.main href="#">
        <i class="fas fa-bookmark mr-2"></i>Bookmarks
    </x-links.main>

    <x-links.main href="#">
        <i class="fas fa-list mr-2"></i>Lists
    </x-links.main>

    <x-links.main href="{{ route('profiles', current_user()->username) }}" :active="request()->routeIs('profile*')">
        <i class="fas fa-user mr-2"></i>My Profile
    </x-links.main>

    <x-links.main href="#">
        <i class="fas fa-ellipsis-h mr-2"></i>More
    </x-links.main>

    <x-links.main href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt mr-2"></i>Sign out
    </x-links.main>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

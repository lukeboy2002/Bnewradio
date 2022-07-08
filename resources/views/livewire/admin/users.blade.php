<div>
    <x-loading />

    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="bg-gray-50 border border-gray-200 flex justify-between items-center py-3 px-6 mb-6 sm:rounded-lg">
            <div class="flex items-center text-red-700">
                <i class="fas fa-users-cog mr-2"></i>
                <h3 class="text-md font-bold">User Management</h3>
                <div class="ml-12 flex shadow-sm">
                    <div class="relative flex items-stretch flex-grow focus-within:z-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-users h-5 w-5 text-gray-400"></i>
                        </div>
                        <input wire:model="search" type="text" name="search" id="search" class="focus:ring-red-700 focus:border-red-500 block w-full rounded-lg pl-10 sm:text-sm border-gray-300" placeholder="Search User">
                    </div>
                </div>
            </div>

            <div>
                <x-links.default_btn href="{{ route('admin.users.create') }}" class="bg-red-700"><i class="fa-solid fa-user-plus mr-2"></i>Add User</x-links.default_btn>
            </div>
        </div>

        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    {{--                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last seen</th>--}}
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{asset('storage/'.$user->avatar)}}" alt="avatar">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">{{ $user->username }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">Regional Paradigm Technician</div>
                            <div class="text-sm text-gray-500">Optimization</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @foreach ($user->roles as $role)
                                @if($role->id == 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                {{ $role->name }}
                            </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $role->name }}
                            </span>
                                @endif
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(Cache::has('user-is-online-' . $user->id))
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Online</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Offline</span>
                            @endif
                        </td>
                        {{--                        <td class="px-6 py-4 whitespace-nowrap text-sm">--}}
                        {{--                            {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}--}}
                        {{--                        </td>--}}

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            @if ($user->trashed())
                                <x-links.default_btn href="{{ route('admin.users.trashed.restore' , $user->id) }}" class="bg-red-700">Restore</x-links.default_btn>
                            @else
                                <x-links.default_btn href="{{ route('admin.users.edit' , $user->id) }}" class="bg-gray-600">Edit</x-links.default_btn>
                                <x-buttons.default wire:click="deleteId({{ $user->id }})" class="bg-red-700">Delete</x-buttons.default>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> There are no user yet </span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="px-4 py-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="hidden" @if ($showModal) style="display:block" @endif aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <x-modal>
            <div class="sm:flex sm:items-start">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fa-solid fa-user-slash text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete account</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-3">
                                Once you do delete your account you lose all your data and there's no getting it back.
                            </p>
                            <p class="text-sm text-gray-500 mb-3">
                                Make sure you want to do this.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mt-5 sm:mt-4 flex justify-end space-x-2">
                <x-buttons.default wire:click="close" class="bg-gray-500" data-dismiss="modal">Close</x-buttons.default>
                <x-buttons.default wire:click.prevent="delete()"  class="bg-red-700">Delete</x-buttons.default>
            </div>
        </x-modal>
    </div>
</div>




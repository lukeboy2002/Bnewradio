<div>
    <x-loading />

    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="bg-gray-50 border border-gray-200 flex justify-between items-center py-3 px-6 mb-6 sm:rounded-lg">
            <div class="flex items-center text-red-700">
                <i class="fa-solid fa-clipboard-list mr-2"></i>
                <h3 class="text-md font-bold">Category Management</h3>
            </div>

            <div>
                <x-links.default_btn href="{{ route('admin.permissions.create') }}" class="bg-red-700"><i class="fa-solid fa-clipboard-list mr-2"></i>Add Permission</x-links.default_btn>
            </div>
        </div>

        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles</th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($permissions as $permission)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            <div class="text-sm font-medium text-gray-500">{{ $permission->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @foreach( $permission->roles as $role )
                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <x-links.default_btn href="{{ route('admin.permissions.edit' , $permission->id) }}" class="bg-gray-600">Edit</x-links.default_btn>
                            <x-buttons.default wire:click="deleteId({{ $permission->id }})" class="bg-red-700">Delete</x-buttons.default>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">There are no Permissions yet</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
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
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Permission</h3>
                        <div class="mt-2">
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




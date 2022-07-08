<x-user-layout>
    <x-cards.default>
        <x-slot:header>
            <h3 class="text-lg leading-6 font-medium text-red-700"><i class="fa-solid fa-folder-plus mr-2"></i>Add Role</h3>
            <p class="mt-1 text-sm text-gray-500">Create a new Role</p>
        </x-slot:header>

        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
            @csrf
            <x-form.input type="text" name="name" required />

            <div class="flex space-x-2">
                @foreach($permissions as $permission)
                    <div class="flex items-center h-5">
                        <input id="{{ $permission->id }}"
                               name="permissions[]"
                               value="{{ $permission->id }}"
                               @isset($role)
                               @if(in_array($permissions->id, $role->permissions()->pluck('id')->toArray())) checked @endif
                               @endisset
                               aria-describedby="permissions"
                               type="checkbox"
                               class="focus:ring-red-700 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="{{ $permission->name }}" class="font-medium text-gray-700">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end space-x-2">
                <x-buttons.large type="button" onclick="history.back()" class="bg-gray-400">Cancel</x-buttons.large>
                <x-buttons.large class="bg-red-700">Save</x-buttons.large>
            </div>
        </form>
    </x-cards.default>
</x-user-layout>

<x-user-layout>
    <x-cards.default>

        <x-slot:header>
            <h3 class="text-lg leading-6 font-medium text-red-700"><i class="fa-solid fa-list-check mr-2"></i>Edit Permission</h3>
            <p class="mt-1 text-sm text-gray-500">Change the permission</p>
        </x-slot:header>

        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-form.input name="name" value="{{ $permission->name }}"/>

            <div class="flex space-x-2">
                @if(!$roles->isEmpty())
                    @foreach ($roles as $role)
                        <div class="flex items-center h-5">
                            <input id="{{ $role->id }}"
                                   name="roles[]"
                                   value="{{ $role->id }}"

                                   @isset($permission)
                                   @if(in_array($role->id, $permission->roles->pluck('id')->toArray())) checked @endif
                                   @endisset


                                   aria-describedby="roles"
                                   type="checkbox"
                                   class="focus:ring-red-700 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="{{ $role->name }}" class="font-medium text-gray-700">{{ $role->name }}</label>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="flex justify-end space-x-2">
                <x-buttons.large type="button" onclick="history.back()" class="bg-gray-400">Cancel</x-buttons.large>
                <x-buttons.large class="bg-red-700">Update</x-buttons.large>
            </div>
        </form>
    </x-cards.default>
</x-user-layout>

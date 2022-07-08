<x-user-layout>
    <x-cards.default>
        <x-slot:header>
            <h2 id="applicant-information-title" class="text-lg leading-6 font-medium text-gray-900"><i class="fa-solid fa-user-tag mr-2"></i>Edit User</h2>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Change the user</p>
        </x-slot:header>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-form.input type="text" name="username" value="{{ $user->username }}" readonly />
            <x-form.input type="email" name="email" value="{{ $user->email }}" readonly />

            <div class="flex space-x-2">
                @foreach($roles as $role)
                    <div class="flex items-center h-5">
                        <input id="{{ $role->id }}"
                               name="roles[]"
                               value="{{ $role->id }}"
                               @isset($user)
                                   @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif
                               @endisset
                               aria-describedby="role"
                               type="radio"
                               class="focus:ring-red-700 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="{{ $role->name }}" class="font-medium text-gray-700">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end space-x-2">
                <x-buttons.large type="button" onclick="history.back()" class="bg-gray-400">Cancel</x-buttons.large>
                <x-buttons.large class="bg-red-700">Update</x-buttons.large>
            </div>
        </form>
    </x-cards.default>
</x-user-layout>

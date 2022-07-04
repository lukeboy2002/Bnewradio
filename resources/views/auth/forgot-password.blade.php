<form action="{{ route('password.request') }}" method="POST" class="space-y-6">
    @csrf
    <div class="sm:flex sm:items-start">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <i class="fa-solid fa-lock-open text-red-600"></i>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Forgot your password</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500 mb-3">
                        Don't worry! Just fill in your email and we'll send you a link to reset your password.
                    </p>
                    <x-form.input type="email" name="email" autocomplete="email" required />
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mt-5 sm:mt-4 flex justify-end space-x-2">
        <x-links.default_btn @click="showModal = false" href="" class="bg-gray-400">Cancel</x-links.default_btn>
        <x-buttons.default class="bg-red-700">Reset password</x-buttons.default>
    </div>
</form>

<x-app-layout>
{{--    <x-messages />--}}

    <div class="flex flex-col h-screen justify-center">
        <x-cards.small>
            <x-slot:header>Register your account </x-slot:header>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
                <x-form.input type="text" name="username" required />

                <x-form.input type="email" name="email" required />

                <x-form.input type="password" name="password" required />
                <x-form.input type="password" name="password_confirmation" required />

                <div>
                    <x-buttons.large class="bg-red-700 w-full">Register</x-buttons.large>
                </div>
            </form>
        </x-cards.small>
    </div>
</x-app-layout>

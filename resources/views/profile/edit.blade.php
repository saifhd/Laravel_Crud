<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <x-success-status :status="session()->get('success')"/>
                    <div class="card border-2 border-gray-300 py-4 px-8">
                        <h3 class="font-bold text-xl mb-4">Account Details</h3>
                        <form action="{{ route('profile.details.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label class="block font-medium text-sm text-gray-700" for="name">Name</label>
                                <input class="rounded w-full" type="text" id="name" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-2">
                                <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                                <input class="rounded w-full" type="email" id="email" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button class="px-8 py-2 rounded-md bg-gray-600 hover:bg-gray-800 text-white" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="card border-2 border-gray-300 py-4 px-8 mt-4">
                        <h3 class="font-bold text-xl mb-4">Edit Password</h3>

                        <form action="{{ route('profile.password.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label class="block font-medium text-sm text-gray-700" for="old_password">Old Password</label>
                                <input class="rounded w-full" type="password" id="old_password" name="old_password" placeholder="Enter Current Password"
                                    value="{{ old('old_password') }}"
                                >
                            </div>
                            <div class="mb-2">
                                <label class="block font-medium text-sm text-gray-700" for="new_password">New Password</label>
                                <input class="rounded w-full" type="password" id="new_password" name="password" placeholder="Enter New Password">
                            </div>
                            <div class="mb-2">
                                <label class="block font-medium text-sm text-gray-700" for="password_confirmation">New Password Confirmation</label>
                                <input class="rounded w-full" type="password" id="password_confirmation" name="password_confirmation" placeholder="New Password Confirmation">
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button class="px-8 py-2 rounded-md bg-gray-600 hover:bg-gray-800 text-white" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

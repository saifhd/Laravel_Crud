<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <x-success-status class="mb-4" :status="session()->get('success')" />

                    <h3 class="text-gray-700 font-bold text-xl mb-5">Update Avatar</h3>
                    <div class="card px-6 py-4 border-2 border-gray-400">
                        @if (isset($employee->avatar_path))
                            <img src="{{ asset('storage/'.$employee->avatar_path) }}" alt="" srcset="" class="h-24 w-24 rounded-full shadow-xl">
                        @else
                            <img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png"
                                class="w-24 h-24 rounded-full" alt="" srcset="">
                        @endif
                        <form action="{{ route('employees.avatar.update',$employee->id) }}" method="post" enctype="multipart/form-data" class="mt-6">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">

                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="avatar">Avatar</label>
                                <input
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="user_avatar_help" id="avatar" type="file" name="avatar">
                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">An avatar
                                    log is useful to confirm
                                    you are logged into your account</div>
                            </div>
                            <button type="submit"
                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                        </form>
                    </div>

                    <h3 class="text-gray-700 font-bold text-xl mb-1">Edit Employee Details</h3>
                    <div class="card px-6 py-4 border-2 border-gray-400">
                        <form action="{{ route('employees.update',$employee->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name
                                    <span class="text-red-600">*</span></label>
                                <input type="text" id="first_name" name="first_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Enter Company Name" value="{{ $employee->first_name }}" required>
                            </div>
                            <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name
                                    <span class="text-red-600">*</span></label>
                                <input type="text" id="last_name" name="last_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Enter Company Name" value="{{ $employee->last_name }}" required>
                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" id="email" name="email" value="{{ $employee->email }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="telephone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ $employee->phone }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="company"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Company</label>
                                <select
                                    class="block appearance-none w-full bg-white border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    name="company" id="company" value="{{ $employee->company_id }}">
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

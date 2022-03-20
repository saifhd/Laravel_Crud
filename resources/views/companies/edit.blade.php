<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <x-success-status :status="session()->get('success')" />

                    <h3 class="text-gray-600 p3-3 pb-1 font-bold text-lg">Company Logo</h3>
                    <div class="card px-4 py-4 border-2 border-gray-200 rounded-md">
                        @if (isset($company->logo_path))
                            <img src="{{ asset('storage/'.$company->logo_path) }}" alt="" srcset="" class="h-24 w-24 rounded-full shadow-xl">
                        @else
                            <img src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png"
                                class="w-24 h-24 rounded-full" alt="" srcset="">
                        @endif

                        <form action="{{ route('companies.logo.update',$company->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="my-2">
                                <input
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="user_avatar_help" id="logo" type="file" name="logo">
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                            </div>
                        </form>
                    </div>

                    <h3 class="text-gray-600 pt-3 pb-1 font-bold text-lg mt-6">Update Details</h3>
                    <div class="card px-4 py-4 border-2 border-gray-200 rounded-md">
                        <form action="{{ route('companies.update',$company->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Company
                                    Name <span class="text-red-600">*</span></label>
                                <input type="text" id="name" name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Enter Company Name" value="{{ $company->name }}" required>
                            </div>
                            <div class="mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" id="email" name="email" value="{{ $company->email }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="telephone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Telephone</label>
                                <input type="text" id="telephone" name="telephone" value="{{ $company->telephone }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="website"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Website</label>
                                <input type="text" id="website" name="website" value="{{ $company->website }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                            </div>
                        </form>
                    </div>

                    <h3 class="text-gray-600 pt-3 pb-1 font-bold text-lg mt-6">Update Cover Images</h3>
                    <div class="card px-4 py-4 border-2 border-gray-200 rounded-md">
                        <div class="grid grid-cols-4 gap-10">
                            @foreach ($company->coverImages as $cover_image)
                                <div class="card shadow-lg rounded-lg">
                                    <img src="{{ asset('storage/'.$cover_image->image_path) }}" class="w-full h-64" alt="">
                                    <form action="{{ route('cover_images.destroy',$cover_image->id) }}" method="post" onsubmit="return confirm('Are sure to perform delete action?')">
                                        @csrf
                                        @method('Delete')
                                        <div class="w-full my-3">
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ route('companies.cover_images.update',$company->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-6 mt-8">
                                <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300" for="cover_images">Add New Cover Images
                                    Images <span class="text-red-600">*</span></label>
                                <input
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="user_avatar_help" id="cover_images" type="file" name="cover_images[]" multiple>
                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">You can
                                    select multiple Cover images</div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

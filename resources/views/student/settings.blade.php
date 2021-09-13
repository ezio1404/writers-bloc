@extends('layouts.app')


@section('content')
<main class="sm:container sm:mx-auto pt-20">
    <div class="w-full sm:px-6">

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
            role="alert">
            {{ session('status') }}
        </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Settings
            </header>

            <div class="py-20">
                <div class="mx-auto w-10/12">
                    <form action="{{ route('student-update-password') }}" method="POST">
                        @csrf

                        <div class="flex items-baseline flex-col lg:flex-row">
                            <label class="block w-full lg:w-1/2  py-4">
                                <span class="text-gray-700 text-2xl font-bold">Change Password</span>
                            </label>
                            <div class="block w-full lg:w-1/2">
                                <label for="current_password" class="block py-4 text-gray-700 font-bold"> <span
                                        class="text-gray-700 font-bold">Old Password</span>
                                    <input type="password"
                                        class="mt-1 form-password mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                        placeholder="Current Password" id="current_password" name="current_password"
                                        value="{{ old('current_password') }}">
                                    @error('current_password')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="new_password" class="block py-4  text-gray-700 font-bold"> <span
                                        class="text-gray-700 font-bold">New Password</span>
                                    <input type="password"
                                        class="mt-1 form-password mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                        placeholder="New Password" id="new_password" name="new_password"
                                        value="{{ old('new_password') }}">
                                    @error('new_password')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="new_password_confirmation" class="block py-4  text-gray-700 font-bold">
                                    <span class="text-gray-700 font-bold">Confirm Password</span>
                                    <input type="password"
                                        class="mt-1 form-password mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                        placeholder="Confirm Password" id="new_password_confirmation"
                                        name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                                    @error('new_password_confirmation')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-row-reverse">
                            <div class="">
                                <input type="submit" class="cursor-pointer p-4 rounded hover:bg-blue-100 "
                                    value="Change Password">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>


    </div>
</main>
@endsection

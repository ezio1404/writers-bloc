@extends('layouts.app')

@section('content')

<section class="flex flex-col items-center h-screen md:flex-row ">
    <div class="hidden w-full h-screen bg-white relative lg:block md:w-1/3 lg:w-2/3 ">
        <div class="absolute bg-white bottom-0 "> </div>
        <img src={{ asset('images/login-bg.jpg')}} alt="" class="object-cover w-full h-full">
    </div>
    <div
        class="flex items-center justify-center w-full h-screen px-6 bg-white md:max-w-md lg:max-w-full md:mx-auto md:w-1/2 xl:w-1/3 lg:px-16 xl:px-12">
        <div class="w-full h-100">
            <a href="/"
                class="flex items-center w-32 mb-4 font-medium text-blueGray-900 title-font md:mb-0">
                <div class="w-2 h-2 p-2 mr-2 rounded-full bg-gradient-to-tr from-blue-300 to-blue-600">
                </div>
                <h2
                    class="text-lg font-bold tracking-tighter text-black uppercase duration-500 ease-in-out transform ttransition hover:text-lightBlue-500 dark:text-blueGray-400">
                    Writer's Bloc </h2>
            </a>
            <h1 class="mt-12 text-2xl font-semibold text-black tracking-ringtighter sm:text-3xl title-font ">Log in to
                your account</h1>
            <form class="mt-6" method="POST" action="{{ route('login') }}"">
                @csrf
          <div>
            <label class=" block text-sm font-medium leading-relaxed tracking-tighter text-blueGray-700">
                {{ __('E-Mail Address') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    placeholder="Your Email "
                    class="w-full px-4 py-2 mt-2 text-base text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-blueGray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 @error('email') border-red-500 @enderror">
                @error('email')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
        </div>
        <div class="mt-4">
            <label
                class="block text-sm font-medium leading-relaxed tracking-tighter text-blueGray-700">{{ __('Password') }}</label>
            <input type="password" placeholder="Your Password" minlength="6"
                class="w-full px-4 py-2 text-base text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-blueGray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 @error('password') border-red-500 @enderror"
                name="password" id="password" type="password" required>
            @error('password')
            <p class="text-red-500 text-xs italic mt-4">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mt-2 text-right">

            @if (Route::has('password.request'))

            <a href="{{ route('password.request') }}"
                class="text-sm font-semibold leading-relaxed text-blueGray-700 hover:text-black focus:text-blue-700">{{ __('Forgot Your Password?') }}</a>
            @endif
        </div>
        <button type="submit"
            class="block w-full px-4 py-4 mt-6 font-semibold text-white transition duration-500 ease-in-out transform bg-black rounded-lg hover:bg-blueGray-800 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 ">Log
            In</button>
        </form>

    </div>
    </div>
</section>

@endsection

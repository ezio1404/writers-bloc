@extends('layouts.app')


@section('content')
<main class="sm:container sm:mx-auto sm:pt-20">
    <div class="w-full sm:px-6">

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
            role="alert">
            {{ session('status') }}
        </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Lesson List
            </header>
        </section>
        <div class="container mx-auto my-5 grid grid-flow-row grid-cols-1 gap-4 ">
            @forelse ($lessons as $lesson)
            <!-- This is an example component -->
            <div class="container mx-auto my-5">

                <div class="relative rounded-lg flex flex-col md:flex-row items-center md:shadow-xl md:h-72 mx-2">

                    <div
                        class="z-0 order-1 md:order-2 relative w-full md:w-2/5 h-80 md:h-full overflow-hidden rounded-lg md:rounded-none md:rounded-r-lg">
                        <div class="absolute inset-0 w-full h-full object-fill object-center bg-blue-400 bg-opacity-30 bg-cover bg-bottom"
                            style="background-image: url( {{ asset('images/login-bg.jpg')}} ); background-blend-mode: multiply;">
                        </div>
                        <div
                            class="md:hidden absolute inset-0 h-full p-6 pb-6 flex flex-col-reverse justify-start items-start bg-gradient-to-b from-transparent via-transparent to-gray-900">
                            <h3 class="w-full font-bold text-2xl text-white leading-tight mb-2">{{ $lesson->title }}
                            </h3>
                            <h4 class="w-full text-xl text-gray-100 leading-tight">
                                {{ $lesson->publish_date->toFormattedDateString()}}</h4>
                        </div>
                        <svg class="hidden md:block absolute inset-y-0 h-full w-24 fill-current text-white -ml-12"
                            viewBox="0 0 100 100" preserveAspectRatio="none">
                            <polygon points="50,0 100,0 50,100 0,100" />
                        </svg>
                    </div>

                    <div class="z-10 order-2 md:order-1 w-full h-full md:w-3/5 flex items-center -mt-6 md:mt-0">
                        <div
                            class="p-8 md:pr-18 md:pl-14 md:py-12 mx-2 md:mx-0 h-full bg-white rounded-lg md:rounded-none md:rounded-l-lg shadow-xl md:shadow-none">
                            <h4 class="hidden md:block text-xl text-gray-400">
                                {{ $lesson->publish_date->toFormattedDateString()}}</h4>
                            <h3 class="hidden md:block font-bold text-2xl text-gray-700">{{ $lesson->title }}</h3>
                            <p class="py-2 text-gray-600 text-justify">{{ $lesson->summary}}</p>
                            <a class="absolute bottom-0 pb-4 flex items-baseline mt-3 text-blue-600 hover:text-blue-900 focus:text-blue-900"
                                href={{ route('lesson-details',$lesson->id)}}>
                                <span>Learn more</span>
                                <span class="text-xs ml-1">&#x279c;</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="max-w-xs sm:max-w-sm mt-8 mx-auto bg-grey-light rounded-lg shadow p-8">
                <h2 class="italic text-right text-blue-darkest leading-normal">
                    Do something now; your future self will thank you for later
                </h2>
                <p class="text-center pt-8 text-grey-darker">
                    - Someone Great
                </p>
            </div>
            @endforelse
        </div>


    </div>
</main>
@endsection

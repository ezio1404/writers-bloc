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
                {{ $announcement->title }}
            </header>

            <div class="container mx-auto">
                <div class="lg:px-10 my-4 py-6 bg-white px-4 ">

                    <div class="mt-2">
                        <h1 class="text-2xl text-gray-700 font-bold hover:text-gray-600">{{ $announcement->title }}</h1>
                        <span class="font-light text-gray-600">
                            {{ $announcement->created_at->toFormattedDateString()}}
                        </span>
                        <p class="whitespace-pre-line mt-12 text-gray-600 leading-normal">{{ $announcement->description }}</p>
                    </div>
                </div>

            </div>

        </section>

    </div>
</main>
@endsection


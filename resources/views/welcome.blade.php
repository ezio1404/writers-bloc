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
                Announcements
            </header>
        </section>
        <div class="container mx-auto my-5 grid grid-flow-row grid-cols-1 gap-4 ">
            <div class="container mx-auto my-5 grid grid-flow-row grid-cols-1 gap-4 ">
                @forelse ($announcements as $announcement)
                <!-- This is an example component -->
                <x-card-component :announcement="$announcement"  />
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


    </div>
</main>
@endsection

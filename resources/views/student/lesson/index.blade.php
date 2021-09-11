@extends('layouts.app')

@section('style')
<style>
    .responsive {
        aspect-ratio: 16 /9 !important;
    }
</style>
@endsection


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
                {{ $lesson->title }}
            </header>

            <div x-data="setup()">
                <ul class="flex justify-center items-center my-4">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                            :class="activeTab===index ? 'text-green-500 border-green-500' : ''"
                            @click="activeTab = index" x-text="tab"></li>
                    </template>
                </ul>

                <div class="text-center mx-auto  lg:px-60">
                    <div x-show="activeTab===0" class="w-full">
                        <video class="" controls>
                            <source src="{{ $lesson->getFirstMediaUrl() }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div x-show="activeTab===1">
                        <div class="w-full h-full">
                            <iframe class="w-full h-full responsive" src="{{$lesson->youtube_embed_url}}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </div>

            <div class="lg:py-16 container mx-auto">
                <div class="lg:px-10 my-4 py-6 bg-white rounded-lg px-4 ">
                    <div class="flex justify-between items-center">
                        <span class="font-light text-gray-600">
                            {{ $lesson->publish_date->toFormattedDateString()}}</span>
                    </div>
                    <div class="mt-2">
                        <h1 class="text-2xl text-gray-700 font-bold hover:text-gray-600">{{ $lesson->title }}</h1>
                        <p class="whitespace-pre-line mt-2 text-gray-600">{{ $lesson->discussion }}</p>
                    </div>

                </div>
            </div>

        </section>

    </div>
</main>
@endsection

@section('scripts')

<script>
    function setup() {
        return {
            activeTab: 0,
            tabs: [
                "Main Media",
                "Youtube Media",
            ]
        };
    };
</script>
@endsection

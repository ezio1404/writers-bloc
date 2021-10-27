@extends('layouts.app')

@section('style')
<style>
    .responsive {
        aspect-ratio: 16 /9 !important;
    }
</style>
@endsection


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
                        <video id="myVideo" class="w-full" controls>
                            <source src="{{ $lesson->getFirstMediaUrl() }}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div x-show="activeTab===1">
                        <div class="w-full h-full responsive" id="player"></div>
                    </div>

                </div>
            </div>

            <div class="lg:py-16 container mx-auto">
                <div class="lg:px-10 my-4 py-6 bg-white px-4 ">
                    <div class="flex justify-between items-center">
                        <span class="font-light text-gray-600">
                            {{ $lesson->publish_date->toFormattedDateString()}}</span>
                    </div>
                    <div class="mt-2">
                        <h1 class="text-2xl text-gray-700 font-bold hover:text-gray-600">{{ $lesson->title }}</h1>
                        <p class="whitespace-pre-line mt-2 text-gray-600 leading-normal">{{ $lesson->discussion }}</p>
                    </div>
                </div>
                <div class="lg:px-10 my-4 py-6 bg-white px-4 flex flex-col lg:flex-row gap-4">
                    <a id="takeQuiz"
                        class="bg-blue-500 block lg:w-1/2 w-full text-white font-bold py-4 px-4 rounded opacity-50 cursor-not-allowed text-center uppercase">
                        @if (!$studentLog)
                        Take Quiz <span class="block text-xs italic"> Watch the whole video to unlock</span>
                        @endif
                        @if($studentLog && $studentLog->studentQuizAnswer)
                        Quiz Completed
                        @endif
                        <a @if($studentLog && $studentLog->studentWritingTaskAnswer->isEmpty())
                            href="{{ route('lesson-writing-task',$lesson->id) }}"
                            @endif
                            class="bg-blue-500 block lg:w-1/2 w-full text-white font-bold py-4 px-4 rounded
                            @if($studentLog && $studentLog->studentWritingTaskAnswer->isEmpty()) cursor-pointer @else
                            opacity-50 cursor-not-allowed @endif text-center uppercase">
                            @if(!$studentLog || ($studentLog && $studentLog->studentWritingTaskAnswer->isEmpty()))
                            Take Writing Task <span class="block text-xs italic"> Take Quiz to unlock</span>
                            @else
                            Writing Task Completed
                            @endif
                        </a>
                </div>
            </div>

        </section>

    </div>
</main>
@endsection

@section('scripts')
<script src="https://www.youtube.com/player_api"></script>
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

    const video = document.getElementById("myVideo");
    let takeQuizNode = document.querySelector('#takeQuiz')
    let att = document.createAttribute("href"); // Create a "href" attribute

    video.onended = function () {
        // change css button
        // Set the value of the href attribute
        if('{{ $studentLog && $studentLog->studentQuizAnswer }}'){
            return;
        }
        att.value = '{{ route('lesson-quiz',$lesson->id) }}';
        takeQuizNode.setAttributeNode(att);
        takeQuizNode.style.opacity = "1";
        takeQuizNode.style.cursor = "pointer";
    };

    var player = document.querySelector('#player');
    // create youtube player
    function onYouTubePlayerAPIReady() {
        player = new YT.Player('player', {
            videoId: '{{ $lesson->youtube_watch_id }}',
            events: {
                onStateChange: onPlayerStateChange
            }
        });
    }

    // when video ends
    function onPlayerStateChange(event) {
        if('{{ $studentLog && $studentLog->studentQuizAnswer }}'){
            return;
        }
        if (event.data === 0) {
            att.value = '{{ route('lesson-quiz',$lesson->id) }}';
            takeQuizNode.setAttributeNode(att);
            takeQuizNode.style.opacity = "1";
            takeQuizNode.style.cursor = "pointer";
        }
    }

</script>
@endsection

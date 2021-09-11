@extends('layouts.teacher')

@section('style')
<style>
    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab a {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of as on hover */
    .tab a:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab a.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;


    }
</style>
@endsection

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="/teacher/lesson">Lesson</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">{{$lesson->title}}</a>
        </li>
    </ol>
</nav>

<nav class="tab flex mt-8 text-center">
    <a href="{{ route('teacher-lesson-show',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-lesson-show') active @endif">Discussion</a>
    <a href="{{route('teacher-quiz',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-quiz') active @endif">Quiz</a>
    <a href="{{route('teacher-writing',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-writing-show') active @endif">Writing
        Task</a>
</nav>




<div class="mt-8">
    <form action={{ route('teacher-lesson-put', $lesson->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Title</span>
                <input type="text"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="title" value="{{ old('title') ?? $lesson->title  }}">
                @error('title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700 font-bold">Discussion</span>
                <textarea
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="discussion">{{ old('discussion') ?? $lesson->discussion  }}</textarea>
                @error('discussion')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <div class="flex justify-between">
                <label class="block w-full mr-4">
                    <span class="text-gray-700 font-bold">Published Date</span>
                    <input type="date"
                        class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                        name="publish_date"
                        value="{{ old('publish_date') ?? $lesson->publish_date->format('Y-m-d')  }}">
                    @error('publish_date')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </label>
                <label class="block w-full">
                    <span class="text-gray-700 font-bold">Due Date</span>
                    <input type="date"
                        class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                        name="due_date" value="{{ old('due_date') ?? $lesson->due_date->format('Y-m-d')   }}">
                    @error('due_date')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <label class="block">
                <span class="text-gray-700 font-bold">Youtube Url <span
                        class="italic text-xs text-gray-400">optional</span></span>
                <input type="text"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="youtube_url" value="{{ old('youtube_url') ?? $lesson->youtube_url }}">
                @error('youtube_url')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <div>
                <h1 class="text-gray-700 font-bold mb-2">Video Preview</h1>
                <div class="flex gap-4">
                    <div class="w-full text-left text-lg pb-1">Main Media</div>
                    <div class="w-full text-left text-lg pb-1">Youtube Media</div>
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <video class="" controls>
                            <source src="{{ $lesson->getFirstMediaUrl() }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="w-full">
                        <iframe class="w-full h-full" src="{{$lesson->youtube_embed_url}}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>



            <label class="block">
                <span class="text-gray-700 font-bold">Video</span>
            </label>
            <input type="file" name="lesson_video" id="lesson_video" class="filepond mt-1">
            @error('lesson_video')
            <span class="text-red-500">{{ $message }}</span>
            @enderror


            <div class="block">
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                        Update Lesson
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection


@section('scripts')
<script>
    const inputElement = document.querySelector('input[id="lesson_video"]');
    const pond = FilePond.create(inputElement)
    FilePond.setOptions({
        server: {
            url: '/upload',
            headers: {
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            }
        }
    });
</script>

@endsection

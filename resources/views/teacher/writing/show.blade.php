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
        <li class="flex items-center">
            <a href={{ route('teacher-lesson-show',$lesson->id) }}>{{ $lesson->title }}</a>
            <x-chevron />
        </li>
        <li class="flex items-center">
            <a href="#">
                Edit Writing Task</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            {{ $lesson->writingTask[0]->task}}
        </li>
    </ol>
</nav>

<nav class="tab flex mt-8 text-center">
    <a href="{{ route('teacher-lesson-show',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-lesson-show') active @endif">Discussion</a>
    <a href="{{route('teacher-quiz',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-quiz' || Route::currentRouteName() == 'teacher-choice-show') active @endif">Quiz</a>
    <a href="{{route('teacher-writing',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-writing-show') active @endif">Writing
        Task</a>
</nav>




<div class="mt-8">
    <form action={{ route('teacher-writing-put', $lesson->writingTask[0]->id)}} method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Writing Task Points<span class="text-red-500">*</span></span>
                <input type="number"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="points" value="{{ old('points')  ??  $lesson->writingTask[0]->points}}">
                @error('points')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <label class="block">
                <span class="text-gray-700 font-bold">Writing Task<span class="text-red-500">*</span></span>
                <textarea
                    class="mt-4 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="task">{{ old('choice') ??  $lesson->writingTask[0]->task}}</textarea>
                @error('task')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <div class="block">
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                        Update Task
                    </button>
                </div>

            </div>
        </div>

    </form>
</div>

@endsection

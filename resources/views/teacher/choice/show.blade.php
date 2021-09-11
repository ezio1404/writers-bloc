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
            <a
                href="{{ route('teacher-quiz-show',['lessonId' =>  $lesson->id, 'quizId' => $lesson->quiz->id]) }}">{{ $lesson->quiz->question}}</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">{{ $lesson->quiz->choices[0]->choice}}</a>
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
    <form action={{ route('teacher-choice-put', $lesson->quiz->choices[0]->id)}} method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
        <input type="hidden" name="quiz_id" value="{{$lesson->quiz->id}}">
        <div class="grid grid-cols-1 gap-6">
            @if ($lesson->quiz->choices[0]->is_correct_choice )
            <div class="bg-red-100 p-4 rounded">
                <span class="text-red-500 font-medium">You are updating the correct answer, please be way of your
                    changes</span>
            </div>
            @endif
            <label class="block">
                <span class="text-gray-700 font-bold">Choice</span>
                <input type="text"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="choice" value="{{ old('choice') ??  $lesson->quiz->choices[0]->choice  }}">
                @error('choice')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <div class="block">
                <div class="mt-2">
                    <a class="bg-yellow-300 hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded"
                        href="{{ route('teacher-quiz-show',['lessonId' =>  $lesson->id, 'quizId' => $lesson->quiz->id]) }}">Cancel
                        Update</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                        Update Choice
                    </button>
                </div>

            </div>
        </div>

    </form>
</div>

@endsection


@section('scripts')

@endsection

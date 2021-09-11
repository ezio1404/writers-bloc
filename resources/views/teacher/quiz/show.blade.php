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
            <a href="#">Edit Quiz</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            {{ $lesson->quiz->question}}
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
    <form action={{ route('teacher-quiz-put', $lesson->quiz->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Quiz Type<span class="text-red-500">*</span></span>
                <select
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    name="type" id="type" onchange="typeChange()" disabled>
                    <option @if($lesson->quiz->type == 'multiple_choice') selected @endif
                        value="multiple_choice">Multiple Choice</option>
                    <option @if($lesson->quiz->type == 'essay') selected @endif value="essay">Essay</option>
                </select>
                @error('type')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <label class="block">
                <span class="text-gray-700 font-bold">Quiz question<span class="text-red-500">*</span></span>
                <textarea
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="question"> {{ old('question') ?? $lesson->quiz->question  }}</textarea>
                @error('question')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Choice
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($lesson->quiz->choices as $choiceItem)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap w-1/3">
                            <div
                                class="text-large @if($choiceItem->is_correct_choice) font-bold @endif font-normal text-gray-900">
                                {{$choiceItem->choice}}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                            <a href={{ route('teacher-choice-show',['lessonId' =>  $lesson->id, 'quizId' => $lesson->quiz->id , 'choiceId' => $choiceItem->id]) }}
                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 p-2 rounded mr-2"><i
                                    class="far fa-edit"></i></a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap" colspan="2">
                            <div class="text-large font-medium text-gray-900 text-center">
                                <blockquote>
                                    “If you give a man a fish, you feed him for a day. If you teach a man to fish, you feed him for a lifetime.”
                                </blockquote>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>



            <div class="block">
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                        Update Quiz Details
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>


@endsection

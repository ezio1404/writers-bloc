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
            <a href="{{ route('teacher-lesson-show',$lesson->id) }}">{{$lesson->title}}</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">Add Quiz</a>
        </li>
    </ol>
</nav>

<nav class="tab flex mt-8 text-center">
    <a href="{{ route('teacher-lesson-show',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-lesson-show') active @endif">Discussion</a>
    <a href="{{route('teacher-quiz',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-quiz') active @endif">Quiz</a>
    <a href="{{route('teacher-writing',$lesson->id)}}"
        class="tablinks w-full @if(Route::currentRouteName() == 'teacher-writing') active @endif">Writing
        Task</a>
</nav>

<div class="mt-16">
    <div class="mt-8">
        <a href={{route('teacher-writing-create',$lesson->id)}}
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Add Writing Task
        </a>
    </div>
    <div class="mt-10">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Question
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Points
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($lesson->writingTask as $writingTask)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-large font-medium text-gray-900">
                                            {{$writingTask->task}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{$writingTask->points}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                                        <a href="{{ route('teacher-writing-show', ['lessonId'=>$lesson->id,'writingTaskId'=>$writingTask->id])}}"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 p-2 rounded mr-2"><i
                                                class="far fa-edit"></i></a>
                                        <form action="{{ route('teacher-writing-destroy',$writingTask->id)}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                            <button
                                                class="text-sm font-medium hover:text-red-900 text-red-500 bg-red-100  rounded p-2"
                                                type="submit"><i class="far fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                                        <div class="text-large font-medium text-gray-900 text-center">
                                            Writing task is empty, lets <a
                                                href="{{route('teacher-writing-create',$lesson->id)}}"
                                                class="text-indigo-500">
                                                Add Writing Task
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

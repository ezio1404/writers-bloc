@extends('layouts.teacher')

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center font-bold">
            <a href="/teacher/lesson">Lesson</a>
        </li>
    </ol>
</nav>

<div class="mt-16">
    <div>
        <a href="/teacher/lesson/create"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Add Lesson
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
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Discussion
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quiz Count
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Writing Task Count
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Due in
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($lessons as $lesson)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-large font-medium text-gray-900">
                                            {{$lesson->title}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap w-1/3">
                                        <div class="text-sm text-gray-900"> {{$lesson->summary}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$lesson->quiz_count}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$lesson->writing_task_count}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if (now() < $lesson->publish_date && !$lesson->deleted_at )
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Published
                                            </span>
                                            @endif
                                            @if ($lesson->due_date <= now()) <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Due
                                                </span>
                                                @endif
                                                @if ($lesson->deleted_at)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Archived
                                                </span>
                                                @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="text-sm text-gray-900">
                                            {{$lesson->due_date->toFormattedDateString()}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                                        <a href="{{ route('teacher-lesson-show',$lesson->id)}}"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 p-2 rounded mr-2"><i
                                                class="far fa-edit"></i></a>
                                                @if (!$lesson->deleted_at)
                                        <form action="{{ route('teacher-lesson-destroy',$lesson->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-sm font-medium hover:text-red-900 text-red-500 bg-red-100  rounded p-2"
                                                type="submit"><i class="far fa-trash"></i></button>
                                        </form>
@endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="7">
                                        <div class="text-large font-medium text-gray-900 text-center">
                                            Lesson is empty, lets <a href={{route('teacher-lesson-create')}}
                                                class="text-indigo-500">
                                                add new Lesson
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

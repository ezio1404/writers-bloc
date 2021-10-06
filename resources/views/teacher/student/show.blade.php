@extends('layouts.teacher')

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="{{ route('teacher-student') }}">Student</a>
            <x-chevron />
        </li>
        <li class="flex items-center">
            <a href=#>{{$student->name}}</a>
        </li>

    </ol>
</nav>

<div class="mt-16">


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
                                        Lesson Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        DISCUSSION
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        QUIZ
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Writing Task
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($student->studentLogs as $studentLog)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-large font-medium text-gray-900">
                                            {{$studentLog->lesson->title}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$studentLog->lesson->discussion}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900">
                                            {{ $studentLog->student_quiz_answer_sum_points ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900">
                                            {{ $studentLog->student_writing_task_answer_sum_points ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                                        <a href="{{ route('teacher-show-student-lesson',['userId' =>  $student->id, 'lessonId' => $studentLog->lesson->id]) }}"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 p-2 rounded mr-2">View
                                            Answers</a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="7">
                                        <div class="text-large font-medium text-gray-900 text-center">
                                            <blockquote class="italic">Choose a job you love, and you will never have to
                                                work a day in your life.</blockquote>
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

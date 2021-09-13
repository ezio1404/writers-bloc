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
                        @forelse ($student->studentLogs as $studentLogs)
                        <div class="p-4">
                            <h1 class="font-bold text-2xl text-gray-900">{{$studentLogs->lesson->title}}</h1>
                            <div class="ml-10">
                                <h1 class="font-bold text-xl">Quiz</h1>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quiz Question
                                            </th>
                                            <th scope="col"
                                                class="w-1/2 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Answer
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
                                        @forelse ($studentLogs->studentQuizAnswer as $studentQuizAnswer)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap ">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$studentQuizAnswer->quiz->question}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap w-1/2">
                                                <span
                                                    class="text-xs leading-snug">{{$studentQuizAnswer->quiz->type == 'multiple_choice'? 'Multiple Choice': 'Essay'}}</span>
                                                <div @class([ 'text-large font-bold text-gray-900' , 'text-red-500'=>
                                                    $studentQuizAnswer->points === 0,
                                                    'text-green-500' => $studentQuizAnswer->points === 1
                                                    ])>
                                                    {{$studentQuizAnswer->answer}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{$studentQuizAnswer->points ?? '-'}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">

                                            </td>

                                        </tr>
                                        @if ($loop->last)
                                        <tr>
                                            <td></td>
                                            <td class="px-6 py-4 whitespace-nowrap w-1/2">
                                                <div class="text-sm text-gray-900">Total Points</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{$studentLogs->student_quiz_answer_sum_points}} </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                                                <div class="text-large font-medium text-gray-900 text-center">
                                                    Empty Quiz Answers
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                            <div class="ml-10">
                                <h1 class="font-bold text-xl">Writing Task</h1>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="w-1/3  px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Writing Task
                                            </th>
                                            <th scope="col"
                                                class="w-1/2 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Answer
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
                                        @forelse ($studentLogs->studentWritingTaskAnswer as $studentWritingTaskAnswer)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$studentWritingTaskAnswer->writingTask->task}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-large font-bold text-gray-900">
                                                    {{$studentWritingTaskAnswer->task_answer}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{$studentWritingTaskAnswer->points ?? '-'}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">

                                            </td>
                                        </tr>
                                        @if ($loop->last)
                                        <tr>
                                            <td></td>
                                            <td class="px-6 py-4 whitespace-nowrap w-1/2">
                                                <div class="text-sm text-gray-900">Total Points</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{$studentLogs->student_writing_task_answer_sum_points ?? '-'}} </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                                <div class="text-large font-medium text-gray-900 text-center">
                                                    Empty Writing Task Answers
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

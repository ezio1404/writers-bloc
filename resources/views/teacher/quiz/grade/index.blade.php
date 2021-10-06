@extends('layouts.teacher')

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="{{ route('teacher-student') }}">Student</a>
            <x-chevron />
        </li>
        <li class="flex items-center">
            <a
                href={{route('teacher-show-student',$student->studentLog->user->id)}}>{{$student->studentLog->user->name}}</a>
            <x-chevron />
        </li>
        <li class="flex items-center">
            <a href=#>Grade Essay Quiz</a>
        </li>
    </ol>
</nav>

<div class="mt-16">

    <div class="mt-10">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <form
                        action={{ route('teacher-grade-quiz-put', ['studentLogId'=> $student->student_log_id,'quizId'=> $student->quiz->id])}}
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="grid grid-cols-1 gap-6">
                            <div class="block">
                                <div class="mt-2">
                                    <label class="mr-4">
                                        <span class="text-gray-700 font-bold">Student Grade<span
                                                class="text-red-500">*</span></span>
                                        <input required type="number" max="5" min="1"
                                            class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                            name="grade" id="grade" value={{ old('grade') ?? $student->points}}>
                                        @error('grade')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-2 rounded">
                                        Grade Essay Quiz
                                    </button>
                                </div>
                            </div>
                            <div class="block">
                                <details>
                                    <summary class="text-gray-700 font-bold cursor-pointer">Quiz Details <span
                                            class="text-red-500 italic text-sm">click for more quiz details info</span>
                                    </summary>
                                    <label class="mr-4">
                                        <span class="text-gray-700 font-bold">Essay Max points
                                            <input type="number" disabled
                                                class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                                name="max_points" id="max_points" value="5">
                                            @error('max_points')
                                            <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                    </label>
                                    <label class="block">
                                        <span class="text-gray-700 font-bold">Quiz question
                                            <textarea disabled
                                                class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                                rows="2"> {{ $student->quiz->question  }}</textarea>

                                    </label>
                                </details>

                            </div>
                            <label class="block">
                                <span class="text-gray-700 font-bold">Student Quiz Answer
                                    <textarea disabled
                                        class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                                        rows="10"> {{ $student->answer  }}</textarea>

                            </label>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

@extends('layouts.teacher')

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="#">Student</a>
        </li>

    </ol>
</nav>

<div class="mt-16">
    <details @if($students->isEmpty()) open @endif>
        <summary class="text-2xl font-bold text-black cursor-pointer">Import Students <span
                class="text-red-500 italic text-sm">Student must not have duplicated id and email</span></summary>
        <form method="POST" action="{{ route('import')}}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <label class="block w-1/2">
                    <span class="text-gray-700 font-bold">Import Students <span class="text-red-500">*</span></span>
                    <input
                        class="mt-1 w-full mb-2 block p-2 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                        placeholder="" type="file" name="excel" id="excel">
                    @error('excel')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </label>

            </div>

            <div class="block pt-4">
                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        Import File
                    </button>
                </div>
            </div>
        </form>
    </details>

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
                                        Student Id
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student Fullname
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lesson Taken (quiz and writing Task)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grade Student
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-large font-medium text-gray-900">
                                            {{$student->id}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$student->name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$student->email}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900">
                                            @foreach ($student->studentLogs as $studentLogs )
                                            <div
                                                @class([ 'px-2 inline-block text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'=>
                                                !$studentLogs->studentQuizAnswer->isEmpty() &&
                                                !$studentLogs->studentWritingTaskAnswer->isEmpty(),
                                                'px-2 inline-block text-xs leading-5 font-semibold rounded-full
                                                bg-yellow-100 text-yellow-800' =>
                                                $studentLogs->studentQuizAnswer->isEmpty() ||
                                                $studentLogs->studentWritingTaskAnswer->isEmpty()
                                                ])>
                                                <a
                                                    href="{{ route('teacher-show-student-lesson',['userId' =>  $student->id, 'lessonId' => $studentLogs->lesson->id]) }}">
                                                    {{ $studentLogs->lesson->title }}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                                        <a href="{{ route('teacher-show-student',$student->id)}}"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 p-2 rounded mr-2"><i
                                                class="far fa-edit"></i> Grade</a>
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

@extends('layouts.teacher')


@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="/teacher/lesson">Lesson</a>
            <x-chevron />
        </li>
        <li class="flex items-center">
            <a href={{ route('teacher-lesson-show',$lesson->id)}}>{{$lesson->title}}</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">Add Writing Task</a>
        </li>
    </ol>
</nav>


<div class="mt-16">

    <form action={{ route('teacher-writing-store',$lesson->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Writing Task Points<span class="text-red-500">*</span></span>
                <input type="number"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="points" value="{{ old('points') }}">
                @error('points')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <label class="block">
                <span class="text-gray-700 font-bold">Writing Task<span class="text-red-500">*</span></span>
                <textarea
                    class="mt-4 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="task">{{ old('task') }}</textarea>
                @error('task')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <div class="block pt-4">
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                    Save Writing Task
                </button>
            </div>
        </div>
    </form>


</div>

@endsection


@section('scripts')

@endsection

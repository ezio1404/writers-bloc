@extends('layouts.teacher')

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="/teacher/lesson">Lesson</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">Create Lesson</a>
        </li>
    </ol>
</nav>

<nav class="my-5" aria-label="tab nav">
    <ol class="list-none p-0 flex justify-around text-center">
        <li class="p-4 bg-red-100 w-full">Discussion</li>
        <li class="p-4 bg-green-100 w-full">Quiz</li>
        <li class="p-4 bg-blue-100 w-full">Writing Task</li>
    </ol>
</nav>

<div class="mt-16">
    <form action={{ route('teacher-lesson-store')}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Title</span>
                <input type="text"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="title" value="{{ old('title') }}">
                @error('title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700 font-bold">Discussion</span>
                <textarea
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="discussion">{{ old('discussion') }}</textarea>
                @error('discussion')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <div class="flex justify-between">
                <label class="block w-full mr-4">
                    <span class="text-gray-700 font-bold">Published Date</span>
                    <input type="date"
                        class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                        name="publish_date" value="{{ old('publish_date') }}">
                    @error('publish_date')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </label>
                <label class="block w-full">
                    <span class="text-gray-700 font-bold">Due Date</span>
                    <input type="date"
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    name="due_date" value="{{ old('due_date') }}">
                    @error('due_date')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <label class="block">
                <span class="text-gray-700 font-bold">Video</span>
                <input type="file" name="lesson_video" id="lesson_video" class="filepond mt-1">
                @error('lesson_video')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>


            <div class="block">
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                        Save Lesson
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection


@section('scripts')
<script>
    const inputElement = document.querySelector('input[id="lesson_video"]');
    const pond = FilePond.create(inputElement)
    FilePond.setOptions({
        server: {
            url: '/upload',
            headers: {
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            }
        }
    });
</script>

@endsection()

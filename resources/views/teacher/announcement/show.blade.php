@extends('layouts.teacher')

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="{{ route('teacher-announcement') }}">Announcement</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">{{$announcement->title}}</a>
        </li>
    </ol>
</nav>

<div class="mt-8">
    <form action={{ route('teacher-announcement-put', $announcement->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Title</span>
                <input type="text"
                    class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    placeholder="" name="title" value="{{ old('title') ?? $announcement->title  }}">
                @error('title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700 font-bold">Description</span>
                <textarea
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="description">{{ old('description') ?? $announcement->description  }}</textarea>
                @error('description')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>



            <div class="block">
                <div class="mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                        Update Announcement
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection



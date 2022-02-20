@extends('layouts.teacher')


@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="{{ route('teacher-student') }}">Student</a>
            <x-chevron />
        </li>
        <li class="flex items-center font-bold">
            <a href="#">Edit Student</a>
        </li>
    </ol>
</nav>


<div class="mt-16">
    <h1 class="mb-12">{{ $user->name }}</h1>
    <form action={{ route('teacher-student-update', $user)}} method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6">
            <x-student-input-component title="Firstname" field="firstname" value="{{ $user->firstname }}" />
            <x-student-input-component title="Lastname" field="lastname" value="{{ $user->lastname }}"/>
            <x-student-input-component title="Email" field="email" value="{{ $user->email }}"/>
        </div>

        <div class="block">
            <div class="mt-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                    Save Student
                </button>
            </div>
        </div>
    </form>


</div>

@endsection


@section('scripts')

@endsection

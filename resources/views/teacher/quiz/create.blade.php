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
            <a href="#">Add quiz</a>
        </li>
    </ol>
</nav>


<div class="mt-16">

    <form action={{ route('teacher-quiz-store',$lesson->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700 font-bold">Quiz Type<span class="text-red-500">*</span></span>
                <select
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    name="type" id="type" onchange="typeChange()">
                    <option selected value="multiple_choice">Multiple Choice</option>
                    <option value="essay">Essay</option>
                </select>
                @error('type')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <label class="block">
                <span class="text-gray-700 font-bold">Quiz question<span class="text-red-500">*</span></span>
                <textarea
                    class="mt-1 mb-2 block  w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                    rows="10" name="question">{{ old('question') }}</textarea>
                @error('question')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <div class="ml-16" id="choice_container">
                @for ($i = 0; $i < 4; $i++) <label class="block">
                    <span class="text-gray-700 font-bold">Choice {{$i + 1}} @if ($i == 0)
                        <span class="text-red-500 text-xs italic">* First
                            choice is always the correct answer</span>
                        @endif</span>
                    <input type="text"
                        class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                        placeholder="" name="choice[]" value="{{ old('choice.'.$i) }}">
                    @error('choice.'.$i)
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    </label>
                    @endfor
            </div>
        </div>




        <div class="block">
            <div class="mt-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded">
                    Save Quiz
                </button>
            </div>
        </div>
    </form>


</div>

@endsection


@section('scripts')
<script>
    document.getElementById("type").click()
    const choiceContainer = document.querySelector('#choice_container');
const typeChange = () => {
  const selected_type = document.getElementById("type").value;
console.log(selected_type)
choiceContainer.style.display = selected_type == 'multiple_choice' ? 'block' : 'none'
}
</script>
@endsection

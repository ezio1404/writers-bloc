@extends('layouts.app')


@section('content')
<main class="pt-20 sm:container sm:mx-auto ">
    <div class="w-full sm:px-6">

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
            role="alert">
            {{ session('status') }}
        </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Lesson Writing Task
            </header>
            <form action="{{ route('lesson-writing-task-store') }}" method="POST">
                @csrf
                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                <div class="grid grid-cols-1 gap-6 p-4 lg:p-10">
                    @foreach ($lesson->writingTask as $task)
                    <div class="block">
                        <span class="text-gray-700 font-bold">{{$task->task}}<span class="text-red-500">*</span></span>
                        <textarea required name="writingTaskAnswers[{{$task->id}}]"
                            class="form-textarea mt-4 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
                            rows="7"></textarea>
                        @if($errors->has("writingTaskAnswers.$task->id"))
                        <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                            <strong>{{ $errors->first("writingTaskAnswers.$task->id") }}</strong>
                        </span>
                        @endif
                    </div>
                    @endforeach
                    <input
                        class="cursor-pointer bg-blue-500 block w-full  text-white font-bold py-4 px-4 rounded text-center uppercase"
                        type="submit" value="Submit Writing Task Answers">
                </div>
            </form>

        </section>


    </div>
</main>
@endsection

@section('scripts')
<script>

</script>
@endsection

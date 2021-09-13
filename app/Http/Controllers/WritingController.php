<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\WritingTask;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WritingController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'writingTask'
        ])->first();

        return view('teacher.writing.index', ['lesson' => $lesson]);
    }

    public function create($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);

        return view('teacher.writing.create', [
            "lesson" => $lesson
        ]);
    }

    public function store(Request $request, $lessonId)
    {
        $validatedData = $request->validate([
            'points' => ['required'],
            'task' => ['required'],
        ]);

        $lesson = Lesson::findOrFail($lessonId);

        WritingTask::create([
            'lesson_id' => $lesson->id,
            'points' => $validatedData['points'],
            'task' => $validatedData['task'],
        ]);

        Alert::toast('Added new Writing Task', 'success');
        return redirect()->route('teacher-writing', $lesson->id);
    }


    public function destroy(Request $request, $writingTaskId)
    {
        $writingTask = WritingTask::findOrFail($writingTaskId);
        $writingTask->delete();

        Alert::toast('Removed Writing Task', 'success');
        return redirect()->route('teacher-writing', $request->lesson_id);
    }

    public function show($lessonId, $writingTaskId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'writingTask' => function ($q) use ($writingTaskId) {
                return $q->whereId($writingTaskId);
            },
        ])->first();


        return view('teacher.writing.show', [
            "lesson" => $lesson
        ]);
    }

    public function put(Request $request, $writingTaskId)
    {
        $validatedData = $request->validate([
            'task' => ['required'],
            'points' => ['required'],
        ]);

        $quiz = WritingTask::findOrFail($writingTaskId);
        $quiz->update($validatedData);

        Alert::toast('Updated Writing Task Details', 'success');
        return redirect()->back();
    }
}

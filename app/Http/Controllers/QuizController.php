<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Models\Lesson;
use App\Models\Quiz;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class QuizController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'quizzes.choices'
        ])->first();

        return view('teacher.quiz.index', [
            "lesson" => $lesson,
        ]);
    }

    public function create($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        return view('teacher.quiz.create', [
            "lesson" => $lesson
        ]);
    }

    public function show($lessonId , $quizId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'quiz' => function ($q) use ($quizId) {
                return $q->whereId($quizId)->with('choices');
            },
        ])->first();

        return view('teacher.quiz.show', [
            "lesson" => $lesson
        ]);
    }


    public function store(Request $request, $lessonId)
    {
        $validatedData = [];
        if ($request->type == 'multiple_choice') {
            $validatedData = $request->validate([
                'type' => ['required', 'max:255'],
                'question' => ['required'],
                'choice' => ['required'],
                'choice.*' => ['required', 'distinct'],
            ]);
            $validatedData['points'] = 1;
        } else {
            $validatedData = $request->validate([
                'type' => ['required', 'max:255'],
                'question' => ['required'],
            ]);
            $validatedData['points'] = 5;
        }

        try {
            DB::beginTransaction();
            $lesson = Lesson::findOrFail($lessonId);

            if ($request->type == 'multiple_choice') {
                $quiz = Quiz::create([
                    'question' => $validatedData['question'],
                    'type' => $validatedData['type'],
                    'points' => $validatedData['points'],
                    'lesson_id' => $lesson->id,
                ]);
                collect($validatedData['choice'])->map(function ($choiceItem, $index) use ($quiz) {
                    Choices::create([
                        'quiz_id' => $quiz->id,
                        'choice' => $choiceItem,
                        'is_correct_choice' => $index == 0,
                    ]);
                });
            } else {
                Quiz::create([
                    'question' => $validatedData['question'],
                    'type' => $validatedData['type'],
                    'points' => $validatedData['points'],
                    'lesson_id' => $lesson->id,
                ]);
            }

            DB::commit();
            Alert::toast('Added new Quiz', 'success');
            return redirect()->route('teacher-quiz', $lesson->id);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function destroy(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->delete();

        Alert::toast('Removed Quiz', 'success');
        return redirect()->route('teacher-quiz', $request->lesson_id);
    }

    public function put(Request $request, $quizId)
    {
        $validatedData = $request->validate([
            'question' => ['required'],
        ]);

        $quiz = Quiz::findOrFail($quizId);
        $quiz->update($validatedData);

        Alert::toast('Updated Quiz Details', 'success');
        return redirect()->back();
    }
}

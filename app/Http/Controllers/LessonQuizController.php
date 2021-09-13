<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Models\Lesson;
use App\Models\StudentLesson;
use App\Models\StudentLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class LessonQuizController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'quizzes' => function ($q) {
                return $q->with([
                    'choices' => function ($q) {
                        return $q->select('id', 'quiz_id', 'choice')->inRandomOrder();
                    },
                ])->orderBy('type', 'desc');
            }
        ])->first();

        return view('student.quiz.index', [
            'lesson' => $lesson,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quizAnswer.*' => ['required'],
            'quizAnswer' => ['array', 'required'],
        ]);

        try {
            DB::beginTransaction();

            $studentLog = StudentLog::create([
                'user_id' => Auth::user()->id,
                'lesson_id' => $request->lesson_id,
            ]);

            foreach ($request->quizAnswer as $quizId => $answer) {
                $choice = Choices::whereId($answer)->first();
                StudentLesson::create([
                    'student_log_id' => $studentLog->id,
                    'quiz_id' => $quizId,
                    'choice_id' => $choice ? $choice->id : null,
                    'answer' =>  $choice ? $choice->choice :  $answer,
                    'points' => $choice ? $choice->is_correct_choice : null,
                ]);
            }

            DB::commit();

            Alert::toast('Quiz Taken', 'success');
            return redirect()->route('lesson-details',$request->lesson_id);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}

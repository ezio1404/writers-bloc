<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\StudentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLessonController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'quizzes.choices:id,quiz_id,choice',
        ])->first();

        $user = Auth::user();

        $studentLog = StudentLog::where([
            'user_id' => $user->id,
            'lesson_id' => $lessonId,
        ])->with([
            'studentQuizAnswer',
            'studentWritingTaskAnswer',
        ])->first();


        // return response()->json($studentLog);

        $pattern = '/(https:\/\/www\.youtube\.com\/watch\?v=)|(\&ab_channel=?\w*)/i';
        $youtube_watch_id = preg_replace($pattern, '', $lesson->youtube_url);
        $lesson->youtube_embed_url = "https://www.youtube.com/embed/{$youtube_watch_id}";
        $lesson->youtube_watch_id = $youtube_watch_id;

        // return response()->json($studentLog);

        return view('student.lesson.index', [
            'lesson' => $lesson,
            'studentLog' => $studentLog
        ]);
    }
}

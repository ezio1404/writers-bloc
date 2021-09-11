<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class StudentLessonController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'quizzes.choices:id,quiz_id,choice',
        ])->first();

        $pattern = '/(https:\/\/www\.youtube\.com\/watch\?v=)|(\&ab_channel=?\w*)/i';
        $youtube_watch_id = preg_replace($pattern, '', $lesson->youtube_url);
        $lesson->youtube_embed_url = "https://www.youtube.com/embed/{$youtube_watch_id}";

        return view('student.lesson.index', [
            'lesson' => $lesson,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::with([
            'logs' => function ($q) {
                return $q->where('user_id', Auth::user()->id)->with([
                    'studentQuizAnswer',
                    'studentWritingTaskAnswer'
                ])
                    ->withCount([
                        'studentQuizAnswer',
                        'studentWritingTaskAnswer'
                    ])
                    ->first();
            },
        ])->get();

        // return response()->json($lessons);
        if (auth()->user()->hasRole('teacher')) {
            $students = User::with([
                'studentLogs' => function ($q) {
                    return $q->with([
                        'lesson',
                        'studentQuizAnswer:id,student_log_id,points',
                        'studentWritingTaskAnswer:id,student_log_id,points'
                    ]);
                },
            ])->get()->except(1);

            return view('teacher.index', [
                'students' => $students
            ]);
        }

        return view('student.index', [
            'lessons' => $lessons,
        ]);
    }

    public function settings()
    {
        if (auth()->user()->hasRole('teacher')) {
            $students = User::with([
                'studentLogs' => function ($q) {
                    return $q->with([
                        'lesson',
                        'studentQuizAnswer:id,student_log_id,points',
                        'studentWritingTaskAnswer:id,student_log_id,points'
                    ]);
                },
            ])->get()->except(1);

            return view('teacher.index', [
                'students' => $students
            ]);
        }

        return view('student.settings', [
            'user' => Auth::user(),
        ]);
    }

    public function slash()
    {
        if (auth()->user()->hasRole('teacher')) {
            $students = User::with([
                'studentLogs' => function ($q) {
                    return $q->with([
                        'lesson',
                        'studentQuizAnswer:id,student_log_id,points',
                        'studentWritingTaskAnswer:id,student_log_id,points'
                    ]);
                },
            ])->get()->except(1);

            return view('teacher.index', [
                'students' => $students
            ]);
        }
        $lessons = Lesson::all();

        return view('welcome', [
            'lessons' => $lessons,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
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

        return view('student.index', [
            'lessons' => $lessons,
        ]);
    }

    public function settings()
    {
        return view('student.settings', [
            'user' => Auth::user(),
        ]);
    }
}

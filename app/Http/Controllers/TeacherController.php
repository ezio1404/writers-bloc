<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{
    public function dashboard()
    {
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

    public function import(Request $request)
    {
        Excel::import(new UsersImport, $request->excel);
        Alert::toast('Imported Students', 'success');


        $students = User::all()->except(1);

        return view('teacher.index', [
            'students' => $students
        ]);
    }

    public function show($userId)
    {
        $student = User::whereId($userId)
            ->with([
                'studentLogs' => function ($q) {
                    return $q->with([
                        'lesson',
                        'studentQuizAnswer' => function ($q) {
                            return $q->with('quiz.choices');
                        },
                        'studentWritingTaskAnswer' => function ($q) {
                            return $q->with('writingTask');
                        },
                    ])
                    ->withSum('studentQuizAnswer','points')
                    ->withSum('studentWritingTaskAnswer','points');
                }
            ])
            ->first();



        // return response()->json($student);

        return view('teacher.student.show', [
            'student' => $student
        ]);
    }

    public function index()
    {
        $students = User::with([
            'studentLogs' => function ($q) {
                return $q->with([
                    'lesson',
                    'studentQuizAnswer:id,student_log_id,points',
                    'studentWritingTaskAnswer:id,student_log_id,points'
                ]);
            },
        ])->get()->except(1);


        return view('teacher.student.index', [
            'students' => $students
        ]);
    }
}

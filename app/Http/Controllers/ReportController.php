<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class ReportController extends Controller
{
    public function index()
    {
         return view('teacher.report.index');
    }

    public function getStudents(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with([
                'studentLogs' => function ($q) {
                    return $q->with([
                        'lesson',
                        'studentQuizAnswer:id,student_log_id,points',
                        'studentWritingTaskAnswer:id,student_log_id,points'
                    ]);
                },
            ])->get()->except(1);
            return Datatables::of($data)
                ->make(true);
        }
    }
}

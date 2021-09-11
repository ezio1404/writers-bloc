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
    public function index()
    {
        $students = User::all()->except(1);

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
}

<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Lesson;
use App\Models\StudentLesson;
use App\Models\StudentWritingTask;
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
                        'lesson' => function ($q) {
                            $q->withTrashed();
                        },
                        'studentQuizAnswer' => function ($q) {
                            return $q->with('quiz.choices');
                        },
                        'studentWritingTaskAnswer' => function ($q) {
                            return $q->with('writingTask');
                        },
                    ])
                        ->withSum('studentQuizAnswer', 'points')
                        ->withSum('studentWritingTaskAnswer', 'points');
                }
            ])
            ->first();

        // return response()->json($student->studentLogs);

        return view('teacher.student.show', [
            'student' => $student
        ]);
    }

    public function studentLesson($userId, $lessonId)
    {
        $student = User::whereId($userId)
            ->with([
                'studentLogs' => function ($q) use ($lessonId) {
                    return $q->where('lesson_id', $lessonId)->with([
                        'lesson' => function ($q) {
                            $q->withTrashed();
                        },
                        'studentQuizAnswer' => function ($q) {
                            return $q->with('quiz.choices');
                        },
                        'studentWritingTaskAnswer' => function ($q) {
                            return $q->with('writingTask');
                        },
                    ])
                        ->withSum('studentQuizAnswer', 'points')
                        ->withSum('studentWritingTaskAnswer', 'points');
                }
            ])
            ->first();

        // $student = User::whereId($userId)
        //     ->with([
        //         'studentLogs' => function ($q) use ($lessonId) {
        //             return $q->with([
        //                 'lesson',
        //             ])
        //                 ->withSum('studentQuizAnswer', 'points')
        //                 ->withSum('studentWritingTaskAnswer', 'points');
        //         }
        //     ])
        //     ->first();

        // return response()->json($student);

        return view('teacher.student.lesson', [
            'student' => $student
        ]);
    }

    public function index()
    {
        $students = User::with([
            'studentLogs' => function ($q) {
                return $q->with([
                    'lesson' => function ($q) {
                        $q->withTrashed();
                    },
                    'studentQuizAnswer:id,student_log_id,points',
                    'studentWritingTaskAnswer:id,student_log_id,points'
                ]);
            },
        ])->get()->except(1);


        return view('teacher.student.index', [
            'students' => $students
        ]);
    }

    public function gradeQuizShow($studentLogId, $quizId)
    {
        $student = StudentLesson::where([
            ['student_log_id', '=', $studentLogId],
            ['quiz_id', '=', $quizId],
        ])->with([
            'studentLog.user',
            'quiz' => function ($q) {
                return $q->with('lesson')->withTrashed();
            }
        ])->first();

        //   return response()->json($student);

        return view('teacher.quiz.grade.index', [
            'student' => $student
        ]);
    }

    public function gradeWritingTaskShow($studentLogId, $writingTaskId)
    {
        $student = StudentWritingTask::where([
            ['student_log_id', '=', $studentLogId],
            ['writing_task_id', '=', $writingTaskId],
        ])->with([
            'studentLog.user',
            'writingTask' => function ($q) {
                return $q->with('lesson')->withTrashed();
            }
        ])->first();

        //   return response()->json($student);

        return view('teacher.writing.grade.index', [
            'student' => $student
        ]);
    }

    public function gradeQuizPut(Request $request, $studentLogId, $quizId)
    {
        $validatedData = $request->validate([
            'grade' => ['required'],
        ]);

        $student = StudentLesson::where([
            ['student_log_id', '=', $studentLogId],
            ['quiz_id', '=', $quizId],
        ])->with([
            'studentLog.user',
            'quiz' => function ($q) {
                return $q->with(['lesson' => function ($q) {
                    $q->withTrashed();
                }])->withTrashed();
            }
        ])->first();


        $student->update([
            'points' => $request->grade
        ]);

        // return response()->json($student);

        Alert::toast('Graded Essay!', 'success');
        return redirect()->route('teacher-show-student-lesson', [
            'userId' =>  $student->studentLog->user->id,
            'lessonId' =>  $student->quiz->lesson->id
        ]);
    }

    public function gradeWritingTaskPut(Request $request, $studentLogId, $writingTaskId)
    {
        $validatedData = $request->validate([
            'grade' => ['required'],
        ]);

        $student = StudentWritingTask::where([
            ['student_log_id', '=', $studentLogId],
            ['writing_task_id', '=', $writingTaskId],
        ])->with([
            'studentLog.user',
            'writingTask' => function ($q) {
                return $q->with(['lesson' => function ($q) {
                    $q->withTrashed();
                }])->withTrashed();
            }
        ])->first();


        $student->update([
            'points' => $request->grade
        ]);

        Alert::toast('Success Grading writing Task!', 'success');
        return redirect()->route('teacher-show-student-lesson', [
            'userId' =>  $student->studentLog->user->id,
            'lessonId' =>  $student->writingTask->lesson->id
        ]);
    }
}

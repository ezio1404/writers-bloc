<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\StudentLog;
use App\Models\StudentWritingTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class StudentWritingTaskController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'writingTask',
        ])->first();

        return view('student.writing.index', [
            'lesson' => $lesson,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'writingTaskAnswers' => ['required', 'array'],
            'writingTaskAnswers.*' => ['required'],
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $studentLog = StudentLog::where([
                'user_id' => $user->id,
                'lesson_id' => $request->lesson_id,
            ])->first();

            foreach ($request->writingTaskAnswers as $taskId => $answer) {
                StudentWritingTask::create([
                    'student_log_id' => $studentLog->id,
                    'writing_task_id' => $taskId,
                    'task_answer' => $answer,
                ]);
            }

            DB::commit();

            Alert::success('Lesson Completed!', 'Quiz and Writing Tasks completed.');
            return redirect()->route('lesson-details', $request->lesson_id);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}

<?php

use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\WritingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonQuizController;
use App\Http\Controllers\StudentLessonController;
use App\Http\Controllers\StudentWritingTaskController;
use App\Http\Controllers\UserSettingsContoller;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    $lessons = Lesson::all();

    return view('welcome', [
        'lessons' => $lessons,
    ]);
});

Auth::routes();



Route::group(['middleware' => ['role:student', 'auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [HomeController::class, 'settings'])->name('student-settings');
    Route::post('/settings/update-password', [UserSettingsContoller::class, 'updatePassword'])->name('student-update-password');
    Route::prefix('lesson')->group(function () {
        Route::get('/{lessonId}', [StudentLessonController::class, 'index'])->name('lesson-details');
        Route::prefix('quiz')->group(function () {
            Route::get('/{lessonId}', [LessonQuizController::class, 'index'])->name('lesson-quiz');
            Route::post('/', [LessonQuizController::class, 'store'])->name('lesson-quiz-store');
        });
        Route::prefix('writing-task')->group(function () {
            Route::get('/{lessonId}', [StudentWritingTaskController::class, 'index'])->name('lesson-writing-task');
            Route::post('/', [StudentWritingTaskController::class, 'store'])->name('lesson-writing-task-store');
        });
    });
});

Route::group(['middleware' => ['role:teacher', 'auth']], function () {
    Route::prefix('teacher')->group(function () {
        Route::get('/', [TeacherController::class, 'dashboard'])->name('teacher-home');
        Route::post('/student/import', [TeacherController::class, 'import'])->name('import');

        Route::prefix('student')->group(function () {
            Route::get('/', [TeacherController::class, 'index'])->name('teacher-student');
            Route::get('/{userId}', [TeacherController::class, 'show'])->name('teacher-show-student');
            Route::get('/{userId}/{lessonId}/answer', [TeacherController::class, 'studentLesson'])->name('teacher-show-student-lesson');
            Route::get('/{studentLogId}/{quizId}', [TeacherController::class, 'gradeQuizShow'])->name('teacher-grade-quiz');
            Route::put('/{studentLogId}/{quizId}', [TeacherController::class, 'gradeQuizPut'])->name('teacher-grade-quiz-put');
            Route::get('/{studentLogId}/writing-task/{writingTaskId}', [TeacherController::class, 'gradeWritingTaskShow'])->name('teacher-grade-writing-task');
            Route::put('/{studentLogId}/writing-task/{writingTaskId}', [TeacherController::class, 'gradeWritingTaskPut'])->name('teacher-grade-writing-task-put');

        });
        // lesson
        Route::prefix('lesson')->group(function () {
            Route::get('/', [LessonController::class, 'index'])->name('teacher-lesson');
            Route::get('/create', [LessonController::class, 'create'])->name('teacher-lesson-create');
            Route::post('/', [LessonController::class, 'store'])->name('teacher-lesson-store');
            Route::get('/{id}', [LessonController::class, 'show'])->name('teacher-lesson-show');
            Route::put('/{id}', [LessonController::class, 'put'])->name('teacher-lesson-put');
            Route::delete('/{id}', [LessonController::class, 'destroy'])->name('teacher-lesson-destroy');
        });

        Route::prefix('quiz')->group(function () {
            Route::get('/{lessonId}', [QuizController::class, 'index'])->name('teacher-quiz');
            Route::get('/create/{lessonId}', [QuizController::class, 'create'])->name('teacher-quiz-create');
            Route::post('/{lessonId}', [QuizController::class, 'store'])->name('teacher-quiz-store');
            Route::get('{lessonId}/details/{quizId}', [QuizController::class, 'show'])->name('teacher-quiz-show');
            Route::put('/details/{quizId}', [QuizController::class, 'put'])->name('teacher-quiz-put');
            Route::delete('/{quizId}', [QuizController::class, 'destroy'])->name('teacher-quiz-destroy');
        });

        Route::prefix('choice')->group(function () {
            Route::get('{lessonId}/details/{quizId}/{choiceId}', [ChoiceController::class, 'show'])->name('teacher-choice-show');
            Route::put('/choice/{choiceId}', [ChoiceController::class, 'put'])->name('teacher-choice-put');
        });

        Route::prefix('writing')->group(function () {
            Route::get('/{lessonId}', [WritingController::class, 'index'])->name('teacher-writing');
            Route::get('/create/{lessonId}', [WritingController::class, 'create'])->name('teacher-writing-create');
            Route::post('/{lessonId}', [WritingController::class, 'store'])->name('teacher-writing-store');
            Route::get('{lessonId}/{writingTaskId}', [WritingController::class, 'show'])->name('teacher-writing-show');
            Route::put('/details/{writingTaskId}', [WritingController::class, 'put'])->name('teacher-writing-put');
            Route::delete('/{writingTaskId}', [WritingController::class, 'destroy'])->name('teacher-writing-destroy');
        });
    });

    Route::post('/upload', [UploadController::class, 'store']);
});

<?php

use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\WritingController;
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
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['role:student']], function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/lesson/{lessonId}', [\App\Http\Controllers\StudentLessonController::class, 'index'])->name('lesson-details');
    // Route::get('/lesson/quiz/{lessonId}', [\App\Http\Controllers\::class, 'index'])->name('lesson-details');

});

Route::group(['middleware' => ['role:teacher']], function () {
    Route::prefix('teacher')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('teacher-home');
        Route::post('/student/import', [TeacherController::class, 'import'])->name('import');

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

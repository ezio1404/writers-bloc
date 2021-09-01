<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\UploadController;
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
});

Route::group(['middleware' => ['role:teacher']], function () {

    Route::get('/teacher', function () {
        return view('teacher.index');
    })->name('teacher-home');


    Route::prefix('teacher')->group(function () {
        // lesson
        Route::prefix('lesson')->group(function () {
            Route::get('/', [LessonController::class, 'index'])->name('teacher-lesson');
            Route::get('/create', [LessonController::class, 'create'])->name('teacher-lesson-create');
            Route::post('/', [LessonController::class, 'store'])->name('teacher-lesson-store');
            Route::get('/{id}', [LessonController::class, 'show'])->name('teacher-lesson-show');
            Route::put('/{id}', [LessonController::class, 'put'])->name('teacher-lesson-put');
        });


    });


    Route::post('/upload', [UploadController::class, 'store']);
});

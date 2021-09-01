<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();

        return view('teacher.lesson.index', [
            'lessons' => $lessons
        ]);
    }

    public function create()
    {
        return view('teacher.lesson.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'discussion' => ['required'],
            'publish_date' => ['required'],
            'due_date' => ['required', 'date_format:Y-m-d'],
            'lesson_video' => ['required','max:40000'],
        ]);

        $lesson = Lesson::create($validatedData);

        $temporaryFile = TemporaryFile::where('folder', $request->lesson_video)->first();

        if ($temporaryFile) {
            $lesson->addMedia(storage_path('app/public/videos/tmp/' . $request->lesson_video . '/' . $temporaryFile->filename))
                ->toMediaCollection();
            rmdir(storage_path('app/public/videos/tmp/' . $request->lesson_video));
            $temporaryFile->delete();
        }

        return redirect()->route('teacher-lesson');
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);

        return view('teacher.lesson.show', [
            'lesson' => $lesson
        ]);
    }

    public function put(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'discussion' => ['required'],
            'publish_date' => ['required'],
            'due_date' => ['required', 'date_format:Y-m-d'],
            'lesson_video' => ['required','max:40000'],
        ]);

        $lesson = Lesson::find($id);
        $mediaItems = $lesson->getMedia();
        $lessonUpdate = $lesson->update($validatedData);

        $temporaryFile = TemporaryFile::where('folder', $request->lesson_video)->first();

        if ($temporaryFile && $lessonUpdate) {
            $mediaItems[0]->delete();
            $lesson->addMedia(storage_path('app/public/videos/tmp/' . $request->lesson_video . '/' . $temporaryFile->filename))
                ->toMediaCollection();
            rmdir(storage_path('app/public/videos/tmp/' . $request->lesson_video));
            $temporaryFile->delete();
        }

        return redirect()->route('teacher-lesson');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\TemporaryFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::withCount(['quiz', 'writingTask'])->get();

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
            'youtube_url' => ['sometimes'],
            'due_date' => ['required', 'date_format:Y-m-d'],
        ]);
        $validatedData['summary'] = substr($request->discussion, 0, 300);

        try {
            DB::beginTransaction();
            $lesson = Lesson::create($validatedData);

            // $temporaryFile = TemporaryFile::where('folder', $request->lesson_video)->first();

            // if ($temporaryFile) {
            //     $lesson->addMedia(storage_path('app/public/videos/tmp/' . $request->lesson_video . '/' . $temporaryFile->filename))
            //         ->toMediaCollection();
            //     rmdir(storage_path('app/public/videos/tmp/' . $request->lesson_video));
            //     $temporaryFile->delete();
            // }

            DB::commit();
            Alert::toast('Added new Lesson', 'success');

            $lesson->refresh();
            return redirect()->route('teacher-quiz', $lesson->id);
        } catch (Exception $e) {
            DB::rollBack();

            Alert::toast('Something went wrong.', 'error');
            return redirect()->route('teacher-lesson');
        }
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);

        $pattern = '/(https:\/\/www\.youtube\.com\/watch\?v=)|(\&ab_channel=?\w*)/i';
        $youtube_watch_id = preg_replace($pattern, '', $lesson->youtube_url);
        $lesson->youtube_embed_url = "https://www.youtube.com/embed/{$youtube_watch_id}?rel=0";

        return view('teacher.lesson.show', [
            'lesson' => $lesson
        ]);
    }

    public function put(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'discussion' => ['required'],
            'youtube_url' => ['sometimes'],
            'publish_date' => ['required'],
            'due_date' => ['required', 'after:publish_date'],
        ]);

        $validatedData['summary'] = substr($request->discussion, 0, 300);

        $lesson = Lesson::find($id);
        // $mediaItems = $lesson->getMedia();
        $lessonUpdate = $lesson->update($validatedData);

        // $temporaryFile = TemporaryFile::where('folder', $request->lesson_video)->first();

        // if ($temporaryFile && $lessonUpdate) {
        //     $mediaItems[0]->delete();
        //     $lesson->addMedia(storage_path('app/public/videos/tmp/' . $request->lesson_video . '/' . $temporaryFile->filename))
        //         ->toMediaCollection();
        //     rmdir(storage_path('app/public/videos/tmp/' . $request->lesson_video));
        //     $temporaryFile->delete();
        // }
        $lesson->refresh();

        Alert::toast('Updated lesson', 'success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();

        Alert::toast('Removed lesson', 'success');
        return redirect()->route('teacher-lesson');
    }
}

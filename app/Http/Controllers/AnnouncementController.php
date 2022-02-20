<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\AnnouncementMail;
use App\Models\User;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::withTrashed()->get();
        return view('teacher.announcement.index', [
            'announcements' => $announcements
        ]);
    }

    public function create()
    {
        return view('teacher.announcement.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
        ], [
            'title.required' => "Announcement title is required.",
            'description.required' => "Announcement description is required."
        ]);
        try {
            DB::beginTransaction();
            $announcement = Announcement::create($validatedData);


            DB::commit();
            Alert::toast('Added new Announcement', 'success');

            $announcement->refresh();

            // $students = User::withTrashed()->whereIn('email', ['zuming1404@gmail.com', 'ejessa0506@gmail.com'])->select('email')->get();
            // $students = User::withTrashed()->select('email')->get();

            // Mail::to($students[0]->email)->send(new AnnouncementMail($announcement));
            // foreach ($students as $student) {
            //     Mail::to($student->email)->send(new AnnouncementMail($announcement));
            // }

            return redirect()->route('teacher-announcement');
        } catch (Exception $e) {
            DB::rollBack();

            Alert::toast('Something went wrong.', 'error');
            return redirect()->route('teacher-announcement');
        }
    }

    public function show($id)
    {
        $announcement = Announcement::whereId($id)->withTrashed()->first();

        return view('teacher.announcement.show', [
            'announcement' => $announcement
        ]);
    }

    public function put(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
        ], [
            'title.required' => "Announcement title is required.",
            'description.required' => "Announcement description is required."
        ]);

        $announcement = Announcement::find($id);
        $announcement->update($validatedData);

        $announcement->refresh();

        Alert::toast('Updated Announcement', 'success');
        return redirect()->route('teacher-announcement');
    }

    public function destroy($id)
    {
        $announcement = Announcement::withTrashed()->whereId($id)->first();
        $announcement->delete();

        Alert::toast('Removed Announcement', 'success');
        return redirect()->route('teacher-announcement');
    }

    public function restore($id)
    {
        $announcement = Announcement::withTrashed()->whereId($id)->first();
        $announcement->restore();

        Alert::toast('Restored Announcement', 'success');
        return redirect()->route('teacher-announcement');
    }
}

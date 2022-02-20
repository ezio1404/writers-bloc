<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class StudentAnnouncementController extends Controller
{
    public function show(Announcement $announcement)
    {
        return view('student.announcement.show', compact('announcement'));
    }
}

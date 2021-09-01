<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('lesson_video')) {
            $file = $request->file('lesson_video');
            $filename = time() . $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $request->file('lesson_video')->storeAs('public/videos/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);

            return $folder;
        }

        return;
    }
}

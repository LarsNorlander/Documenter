<?php

namespace App\Http\Controllers;

use App\FileRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class FileController extends Controller {
    //
    public function viewFiles()
    {
        $userFiles = FileRecord::with('user')
            ->where('owner_id', Auth::User()->id)
            ->get();
        $deptFiles = FileRecord::with('user')
            ->where('sharing', 'LIKE', "%\"Departmental\": \"true\"%")
            ->where('owner_id', '!=', Auth::User()->id)
            ->get();
        $orgFiles = FileRecord::with('user')
            ->where('sharing', 'LIKE', "%\"Organizational\": \"true\"%")
            ->where('owner_id', '!=', Auth::User()->id)
            ->get();
        $shareFiles = FileRecord::with('user')
            ->where('sharing', 'LIKE', "%\"" . Auth::User()->username ."\": \"true\"%")
            ->where('owner_id', '!=', Auth::User()->id)
            ->get();
        //{ "Read": [ ], "Write": [ ], "Departmental": "Department Name", "Organizational": "true" }
        return View::make('dashboard')
            ->with('userFiles', $userFiles)
            ->with('orgFiles', $orgFiles)
            ->with('shareFiles', $shareFiles)
            ->with('deptFiles', $deptFiles);
        //return $files;
    }

    public function addFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $entry = new FileRecord();
            $entry->mime = $file->getClientMimeType();
            $entry->filename = $file->getClientOriginalName();
            $entry->total_versions = 1;
            $entry->public_version = 1;
            $entry->owner_id = Auth::User()->id;
            $entry->save();

            Storage::disk('local')->put(Auth::User()->id . $entry->id . $file->getClientOriginalName() . "/_1", File::get($file));

            return redirect('/dashboard');
        } else
            return "No file";
    }

    public function getDetails($id)
    {
        $file = FileRecord::where('id', $id)->get();

        return $file;
    }
}

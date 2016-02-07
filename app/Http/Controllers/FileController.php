<?php

namespace App\Http\Controllers;

use App\FileRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class FileController extends Controller {

    public function viewFiles()
    {
        $userFiles = FileRecord::with('user')
            ->where('owner_id', Auth::User()->id)
            ->get();
        $deptFiles = FileRecord::with('user')
            ->where('sharing', 'LIKE', "%" . Auth::User()->user_dept->name . "%")
            ->where('owner_id', '!=', Auth::User()->id)
            ->get();
        $orgFiles = FileRecord::with('user')
            ->where('sharing', 'LIKE', "%\"mass\":\"1\"%")
            ->where('owner_id', '!=', Auth::User()->id)
            ->get();
        $shareFiles = FileRecord::with('user')
            ->where('sharing', 'LIKE', "%" . Auth::User()->username . "%")
            ->where('owner_id', '!=', Auth::User()->id)
            ->get();

        return View::make('dashboard')
            ->with('userFiles', $userFiles)
            ->with('orgFiles', $orgFiles)
            ->with('shareFiles', $shareFiles)
            ->with('deptFiles', $deptFiles);
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

            Storage::disk('local')->put(Auth::User()->id . $entry->id . $file->getClientOriginalName() . "/1", File::get($file));
        } else
            return "No file";
    }

    public function downloadFile($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $file = Storage::disk('local')->get($entry->owner_id . $entry->id . $entry->filename . "/" . $entry->public_version);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }

    public function downloadFileVer($id, $ver)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $file = Storage::disk('local')->get($entry->owner_id . $entry->id . $entry->filename . "/" . $ver);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }

    public function updateFile($id, Request $request)
    {
        $file = $request->file('updateFile');
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        Storage::disk('local')->put(Auth::User()->id . $entry->id . $entry->filename . "/" . ($entry->total_versions + 1), File::get($file));
        $entry->total_versions = $entry->total_versions + 1;
        $entry->public_version = $entry->total_versions;
        $entry->save();

        return redirect('/');
    }

    public function shareFile($id, Request $request)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $users = $request->Users;
        $departments = $request->Departments;
        $mass = $request->Mass;
        $sharing_array = ['users' => $users, 'departments' => $departments, 'mass' => $mass];
        $sharing = json_encode($sharing_array);
        $entry->sharing = $sharing;
        $entry->save();

        return redirect('/');
    }

    public function deleteFile($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        Storage::deleteDirectory($entry->owner_id . $entry->id . $entry->filename);
        $entry->delete();

        return redirect('/');
    }

    public function deleteFileVer($id, $ver)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        Storage::delete($entry->owner_id . $entry->id . $entry->filename . "/" . $ver);

        $files = Storage::allFiles($entry->owner_id . $entry->id . $entry->filename . "/");

        if (count($files) == 0) {
            Storage::deleteDirectory($entry->owner_id . $entry->id . $entry->filename);
            $entry->delete();
        } else if ($ver == $entry->public_version) {
            $last = str_replace($entry->owner_id . $entry->id . $entry->filename . "/", "", end($files));
            $entry->public_version = $last;
            $entry->save();
        }

        return redirect('/');
    }

    public function setPublic($id, $ver)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $entry->public_version = $ver;
        $entry->save();
        return redirect('/');
    }

    public function getDetails($id)
    {
        $file = FileRecord::where('id', $id)->get();

        return $file;
    }
}

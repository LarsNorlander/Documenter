<?php

namespace App\Http\Controllers;


use App\FileRecord;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {

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
            $users = [];
            $departments = [];
            $mass = "0";
            $sharing_array = ['users' => $users, 'departments' => $departments, 'mass' => $mass];
            $sharing = json_encode($sharing_array);
            $entry->sharing = $sharing;
            $entry->doc_type_id = 1;
            $entry->save();

            Storage::disk('local')->put(Auth::User()->id . $entry->id . $file->getClientOriginalName() . "/1", File::get($file));

            //Email Section
            $admins = User::get()->where('user_type_id', 1);
            $uploader = Auth::user()->fname . " " . Auth::user()->lname . " (" . Auth::user()->username . ")";
            $data = ['uploader' => $uploader,
                     'fileName' => $entry->filename,
                     'id'       => $entry->id];
            foreach ($admins as $admin) {
                Mail::queue('mail.newUpload', $data, function ($message) use (&$admin) {
                    $message->to($admin->email, 'Admin')->subject('New Upload');
                });
            }

        } else
            return "No file";
    }

    public function downloadFile($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $file = Storage::disk('local')->get($entry->owner_id . $entry->id . $entry->filename . "/" . $entry->public_version);

        $sharing = (array)json_decode($entry->sharing);

        if (auth::check()) {
            if ($entry->owner_id == Auth::user()->id or
                auth::User()->user_type_id == 1 or
                in_array(Auth::user()->username, $sharing['users']) or
                in_array(Auth::user()->user_dept->name, $sharing['departments']) or
                $sharing['mass'] == 1
            ) {
                return (new Response($file, 200))
                    ->header('Content-Type', $entry->mime);
            } else {
                return "You aren't allowed to access this file.";
            }
        } elseif ($sharing['mass'] == 2) {
            return (new Response($file, 200))
                ->header('Content-Type', $entry->mime);
        } else {
            return "You aren't allowed to access this file.";
        }

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

        $admins = User::get()->where('user_type_id', 1);
        foreach ($admins as $admin) {
            $uploader = Auth::user()->fname . " " . Auth::user()->lname . " (" . Auth::user()->username . ")";
            Mail::queue('mail.adminFileUpdate', ['uploader' => $uploader, 'fileName' => $entry->filename, 'id' => $entry->id, 'version' => $entry->public_version], function ($message) use (&$admin) {
                $message->to($admin->email, $admin->fname)->subject('New File Update');
            });

        }

        return redirect('/');
    }

    public function shareFile($id, Request $request)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $users = (array)$request->Users;
        $departments = (array)$request->Departments;
        $mass = $request->Mass;
        $sharing_array = ['users' => $users, 'departments' => $departments, 'mass' => $mass];
        $sharing = json_encode($sharing_array);
        $entry->sharing = $sharing;
        $entry->save();

        $file = FileRecord::where('id', $id)->firstOrFail();
        $owner = User::where('id', $file->owner_id)->firstOrFail();
        $uploader = $owner->fname . " " . $owner->lname . " (" . $owner->username . ")";


        foreach ($users as $user) {
            $shared = User::where('username', $user)->firstOrFail();
            $data = ['uploader' => $uploader,
                     'fileName' => $entry->filename,];
            Mail::queue('mail.fileShared', $data, function ($message) use (&$shared) {
                $message->to($shared->email, $shared->fname)->subject('A file was shared.');
            });
        }

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

    public function tagFile($id, Request $request)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $docTags = (array) json_decode($entry->tags);
        if (isset($docTags[Auth::User()->username])) {
            $newTags = (array)$request->Tags;
            $docTags[Auth::User()->username] = $newTags;
        } else{
            $newTagsKey = array(Auth::User()->username => (array)$request->Tags);
            $docTags = array_merge($docTags, $newTagsKey);
        }

        $entry->tags = json_encode($docTags);
        $entry->save();

        return redirect('/');
    }
}

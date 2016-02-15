<?php

namespace App\Http\Controllers;

use App\Achievements;
use App\FileRecord;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller {
    public function addAchievement(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $entry = new FileRecord();
            $entry->mime = $file->getClientMimeType();
            $entry->filename = $request->name;
            $entry->total_versions = 1;
            $entry->public_version = 1;
            $entry->owner_id = Auth::User()->id;
            $users = [];
            $departments = [];
            $mass = "0";
            $sharing_array = ['users' => $users, 'departments' => $departments, 'mass' => $mass];
            $sharing = json_encode($sharing_array);
            $entry->sharing = $sharing;
            $entry->doc_type_id = 2;
            $entry->save();

            $achievement = new Achievements();
            $achievement->name = $request->name;
            $achievement->received = $request->received;
            $achievement->type = $request->type;
            $achievement->validity = $request->validity;
            $achievement->details = $request->details;
            $achievement->achievement_id = $entry->id;
            $achievement->save();

            Storage::disk('local')->put(Auth::User()->id . $entry->id . $request->name . "/1", File::get($file));

            $admins = User::get()->where('user_type_id', 1);
            $hrs = User::get()->where('user_dept_id', 2);
            $uploader = Auth::user()->fname . " " . Auth::user()->lname . " (" . Auth::user()->username . ")";
            $data = ['uploader' => $uploader,
                     'fileName' => $entry->filename,
                     'id'       => $entry->id];
            foreach ($admins as $admin) {
                Mail::queue('mail.newUpload', $data, function ($message) use (&$admin) {
                    $message->to($admin->email, 'Admin')->subject('New Upload');
                });
            }
            foreach ($hrs as $hr) {
                Mail::queue('mail.newUpload', $data, function ($message) use (&$hr) {
                    $message->to($hr->email, 'Admin')->subject('New Achievement Upload');
                });
            }

            return redirect('/dashboard/awards');
        } else
            return "No file";
    }

    public function delReqAchievement($id, Request $request)
    {
        $entry = Achievements::where('achievement_id', '=', $id)->firstOrFail();
        $entry->delete_pending = true;
        $entry->delete_details = $request->delDetails;
        $entry->save();
        $file = FileRecord::where('id', $id)->firstOrFail();
        $owner = User::where('id', $file->owner_id)->firstOrFail();
        $uploader = $owner->fname . " " . $owner->lname . " (" . $owner->username . ")";
        $admins = User::get()->where('user_type_id', 1);
        $data = ['uploader' => $uploader,
                 'fileName' => $entry->filename];
        foreach ($admins as $admin) {
            Mail::queue('mail.newDelReq', $data, function ($message) use (&$admin) {
                $message->to($admin->email, 'Admin')->subject('New Delete Request');
            });
        }

        return redirect('/dashboard/awards');
    }

    public function approve($id)
    {
        $entry = Achievements::where('achievement_id', '=', $id)->firstOrFail();
        $entry->approved = true;
        $entry->save();
        $file = FileRecord::where('id', $id)->firstOrFail();
        $owner = User::where('id', $file->owner_id)->firstOrFail();
        $data = ['fileName' => $entry->name];

        Mail::queue('mail.hrApprove', $data, function ($message) use (&$owner) {
            $message->to($owner->email, $owner->fname)->subject('Achievement approved');
        });

        return redirect('/hr/verify');
    }

    public function decline($id)
    {
        $entry = Achievements::where('achievement_id', '=', $id)->firstOrFail();

        $file = FileRecord::where('id', $id)->firstOrFail();
        $owner = User::where('id', $file->owner_id)->firstOrFail();
        $data = ['fileName' => $entry->name];

        Mail::queue('mail.hrDeny', $data, function ($message) use (&$owner) {
            $message->to($owner->email, $owner->fname)->subject('Achievement rejected');
        });

        Storage::deleteDirectory($file->owner_id . $file->id . $file->filename);
        $entry->delete();
        $file->delete();

        return redirect('/hr/verify');
    }
}

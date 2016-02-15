<?php

namespace App\Http\Controllers;

use App\Achievements;
use App\Department;
use App\FileRecord;
use App\Http\Requests;
use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkAuth();
        $allFiles = FileRecord::with('user')
            ->get();

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('allFiles', $allFiles)
            ->with('userTags', $userTags)
            ->with('screen', "admin");
    }


    public function depts()
    {
        $this->checkAuth();
        $allDepts = Department::get();

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('allDepts', $allDepts)
            ->with('userTags', $userTags)
            ->with('screen', "admin")
            ->with('noSidebar', true);
    }

    public function addDepts(Request $request)
    {
        $this->checkAuth();
        $name = $request->collegeName;
        $entry = new Department();
        $entry->name = $name;
        $entry->save();

        return redirect('/admin/depts');
    }

    public function delDepts($id)
    {
        $this->checkAuth();
        //Delete stuff
        Department::destroy($id);

        return redirect('/admin/depts');
    }

    public function users()
    {
        $this->checkAuth();

        $allUsers = User::get();

        $userTags = $this->retrieveTags();
        $departments = Department::get();
        $userTypes = UserType::get();

        return view('dashboard')
            ->with('allUsers', $allUsers)
            ->with('userTags', $userTags)
            ->with('departments', $departments)
            ->with('userTypes', $userTypes)
            ->with('screen', "admin")
            ->with('noSidebar', true);
    }

    public function addUser(Request $request)
    {
        $newUser = new User();
        $newUser->fname = $request->fname;
        $newUser->lname = $request->lname;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->user_status_id = 1;
        $newUser->user_dept_id = $request->department;
        $newUser->user_type_id = $request->userType;

        $newUser->save();

        return redirect('/admin/users');
    }

    public function lockUser($id)
    {
        $this->checkAuth();
        $user = User::where('id', '=', $id)->firstOrFail();

        if ($user->user_status_id == 1) {
            $user->user_status_id = 2;

            Mail::queue('mail.accLocked', [], function ($message) use (&$user) {
                $message->to($user->email, $user->fname)->subject('Account Locked.');
            });
        } else{
            $user->user_status_id = 1;
            Mail::queue('mail.accUnlocked', [], function ($message) use (&$user) {
                $message->to($user->email, $user->fname)->subject('Account Unlocked.');
            });
        }

        $user->save();

        return redirect('/admin/users');
    }

    public function delAwards()
    {
        $userFiles = FileRecord::with('user')->with('achievements')
            ->where('owner_id', Auth::User()->id)
            ->where('doc_type_id', 2)
            ->get();

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('delReq', $userFiles)
            ->with('userTags', $userTags)
            ->with('screen', "admin");
    }

    public function appDelReq($id)
    {
        $achievement = Achievements::where('achievement_id', '=', $id)->firstOrFail();
        $file = FileRecord::where('id', '=', $id)->firstOrFail();
        $owner = User::where('id', '=', $file->owner_id)->firstOrFail();

        $data = [
            'fileName' => $file->filename,];
        Mail::queue('mail.confirmDelete', $data, function ($message) use (&$owner) {
            $message->to($owner->email, $owner->fname)->subject('Delete request approved.');
        });

        Storage::deleteDirectory($file->owner_id . $file->id . $file->filename);
        $achievement->delete();
        $file->delete();

        return redirect('/admin/delete');
    }

    public function denDelReq($id)
    {
        $entry = Achievements::where('achievement_id', '=', $id)->firstOrFail();
        $file = FileRecord::where('id', '=', $id)->firstOrFail();
        $owner = User::where('id', '=', $file->owner_id)->firstOrFail();
        $entry->delete_pending = false;
        $entry->delete_details = "";
        $entry->save();

        $data = [
            'fileName' => $file->filename,];
        Mail::queue('mail.denyDelete', $data, function ($message) use (&$owner) {
            $message->to($owner->email, $owner->fname)->subject('Delete request rejected.');
        });

        return redirect('/admin/delete');
    }

    private function retrieveTags()
    {
        $Tags = (array)json_decode(Auth::User()->user_tags);
        $userTags = [];

        foreach ($Tags as $tag) {
            $userTags[$tag] = $tag;
        }

        return $userTags;
    }

    private function checkAuth()
    {
        if (!(Auth::check() && Auth::user()->user_type_id == 1)) {
            return "You are not allowed to see this.";
        }


    }

}

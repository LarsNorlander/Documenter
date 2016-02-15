<?php

namespace App\Http\Controllers;

use App\Department;
use App\FileRecord;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

class ModalController extends Controller {
    public function addTagModal($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $rawDocTags = (array)json_decode($entry->tags);

        if (isset($rawDocTags[Auth::User()->username]))
            $docTags = $rawDocTags[Auth::User()->username];
        else
            $docTags = [];

        $Tags = (array)json_decode(Auth::User()->user_tags);
        $userTags = [];

        foreach ($Tags as $tag) {
            $userTags[$tag] = $tag;
        }

        return view('modals.fileTagModal')->with('docTags', $docTags)
            ->with('userTags', $userTags)
            ->with('id', $id);
    }

    public function sharing($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $rawSharing = (array)json_decode($entry->sharing);

        $users = User::get();
        $sharedUsers = (array) $rawSharing['users'];

        $departments = Department::get();
        $sharedDepartments = (array) $rawSharing['departments'];

        $mass = $rawSharing['mass'];

        return view('modals.sharingModal')
            ->with('sharedUsers', $sharedUsers)
            ->with('users', $users)
            ->with('departments', $departments)
            ->with('sharedDepartments', $sharedDepartments)
            ->with('mass', $mass)
            ->with('id', $id);
    }
}

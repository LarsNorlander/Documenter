<?php

namespace App\Http\Controllers;

use App\Achievements;
use App\FileRecord;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;


class RightSideBarController extends Controller {
    public function getVersions($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $owner = $entry->owner_id;
        $files = Storage::allFiles($entry->owner_id . $entry->id . $entry->filename . "/");
        $docType = $entry->doc_type_id;
        $i = 0;
        foreach ($files as $file) {
            $files[$i] = str_replace($entry->owner_id . $entry->id . $entry->filename . "/", "", $file);
            $i++;
        }

        return View::make('nav.cards.fileVersions')->with('files', $files)
            ->with('id', $id)
            ->with('owner', $owner)
            ->with('docType', $docType);
    }

    public function getSharing($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $sharing = (array) json_decode($entry->sharing);
        $editors = (array) json_decode($entry->user_editor);

        return view('nav.cards.fileSharing')->with('sharing', $sharing)
            ->with('editors', $editors);
    }

    public function getDelReq($id){
        $entry = Achievements::withTrashed()->where('achievement_id', '=', $id)->firstOrFail();
        $details = $entry->delete_details;

        if($entry->trashed()){
            return view('nav.cards.deleteRestore')
                ->with('details', $details)
                ->with('id', $id);
        }
        else{
            return view('nav.cards.deleteRequest')
                ->with('details', $details)
                ->with('id', $id);
        }

    }

    public function getDetails($id)
    {
        $entry = FileRecord::withTrashed()->where('id', '=', $id)->firstOrFail();

        if ($entry->doc_type_id == 1)
            return view('nav.cards.fileInfo')->with('file', $entry);
        else{
            $achievement = Achievements::withTrashed()->where('achievement_id', '=', $id)->firstOrFail();
            return view('nav.cards.fileInfo')->with('file', $entry)
                ->with('achievement', $achievement);
        }
    }

    public function getTags($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $tags = (array)json_decode($entry->tags);

        if (isset($tags[Auth::User()->username])) {
            $userTags = $tags[Auth::User()->username];
        } else
            $userTags = [];

        return view('nav.cards.fileTags')->with('tags', $userTags);
    }
}

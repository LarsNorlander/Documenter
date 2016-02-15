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
        $files = Storage::allFiles($entry->owner_id . $entry->id . $entry->filename . "/");
        $docType = $entry->doc_type_id;
        $i = 0;
        foreach ($files as $file) {
            $files[$i] = str_replace($entry->owner_id . $entry->id . $entry->filename . "/", "", $file);
            $i++;
        }

        return View::make('nav.cards.fileVersions')->with('files', $files)
            ->with('id', $id)
            ->with('docType', $docType);
    }

    public function getSharing($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $sharing = (array)json_decode($entry->sharing);

        return view('nav.cards.fileSharing')->with('sharing', $sharing);
    }

    public function getDelReq($id){
        $entry = Achievements::where('achievement_id', '=', $id)->firstOrFail();
        $details = $entry->delete_details;

        return view('nav.cards.deleteRequest')
            ->with('details', $details)
            ->with('id', $id);
    }

    public function getDetails($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();

        if ($entry->doc_type_id == 1)
            return view('nav.cards.fileInfo')->with('file', $entry);
        else{
            $achievement = Achievements::where('achievement_id', '=', $id)->firstOrFail();
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
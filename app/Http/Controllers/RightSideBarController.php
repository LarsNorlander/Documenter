<?php

namespace App\Http\Controllers;

use App\FileRecord;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;


class RightSideBarController extends Controller {
    public function getVersions($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $files = Storage::allFiles($entry->owner_id . $entry->id . $entry->filename . "/");
        $i = 0;
        foreach ($files as $file) {
            $files[$i] = str_replace($entry->owner_id . $entry->id . $entry->filename . "/", "", $file);
            $i++;
        }

        return View::make('nav.cards.fileVersions')->with('files', $files)->with('id', $id);
    }

    public function getSharing($id)
    {
        $entry = FileRecord::where('id', '=', $id)->firstOrFail();
        $sharing = json_decode($entry->sharing);

        return view('nav.cards.fileSharing')->with('sharing', $sharing);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function addTag(Request $request)
    {
        $entry = User::where('id', '=', Auth::User()->id)->firstOrFail();
        $curTags = (array) json_decode($entry->user_tags);
        $newTags = explode(",", $request->Tags);

        if (count($curTags) > 0) {
            foreach ($newTags as $tag) {
                if (!in_array($tag, $curTags))
                    array_push($curTags, $tag);
            }
            $tags = $curTags;
        } else
        $tags = $newTags;

        $entry->user_tags = json_encode($tags);
        $entry->save();

        return redirect('/');
    }
}

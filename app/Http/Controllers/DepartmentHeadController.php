<?php

namespace App\Http\Controllers;

use App\Achievements;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FileRecord;
use App\User;
use Illuminate\Support\Facades\Auth;


class DepartmentHeadController extends Controller
{
    public function deptAwards(){
        $deptAwards = FileRecord::with('user')->with('achievements')
            ->where('doc_type_id', 2)
            ->get();

        $userTags = $this->retrieveTags();
        $screen = "deptAwards";

        return view('dashboard')
            ->with('deptAwards', $deptAwards)
            ->with('userTags', $userTags)
            ->with('screen', $screen);
    }

    public function deptArchived(){
        $deptAwards = FileRecord::with('user')->with('achievements')
                                ->where('doc_type_id', 2)
                                ->get();

        $userTags = $this->retrieveTags();
        $screen = "deptArchive";

        return view('dashboard')
            ->with('deptAwards', $deptAwards)
            ->with('userTags', $userTags)
            ->with('screen', $screen);
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
}

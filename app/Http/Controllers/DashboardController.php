<?php

namespace App\Http\Controllers;

use App\FileRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {


    public function index() {
        $userFiles = FileRecord::with('user')
                               ->where('owner_id' , Auth::User()->id)
                               ->where('doc_type_id' , 1)
                               ->get()
        ;
        $shareFiles = FileRecord::with('user')
                                ->where('sharing' , 'LIKE' , "%" . Auth::User()->username . "%")
                                ->where('doc_type_id' , 1)
                                ->where('owner_id' , '!=' , Auth::User()->id)
                                ->get()
        ;
        $editableFiles = FileRecord::with('user')
                                   ->where('user_editor' , 'LIKE' , "%" . Auth::User()->username . "%")
                                   ->where('doc_type_id' , 1)
                                   ->where('owner_id' , '!=' , Auth::User()->id)
                                   ->get()
        ;
        $deptFiles = FileRecord::with('user')
                               ->where('sharing' , 'LIKE' , "%" . Auth::User()->user_dept->name . "%")
                               ->where('sharing' , 'NOT LIKE' , "%" . Auth::User()->username . "%")
                               ->where('doc_type_id' , 1)
                               ->where('owner_id' , '!=' , Auth::User()->id)
                               ->get()
        ;
        $orgFiles = FileRecord::with('user')
                              ->where('sharing' , 'LIKE' , "%\"mass\":\"1\"%")
                              ->where('sharing' , 'NOT LIKE' , "%" . Auth::User()->user_dept->name . "%")
                              ->where('sharing' , 'NOT LIKE' , "%" . Auth::User()->username . "%")
                              ->where('doc_type_id' , 1)
                              ->where('owner_id' , '!=' , Auth::User()->id)
                              ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('userFiles' , $userFiles)
            ->with('orgFiles' , $orgFiles)
            ->with('shareFiles' , $shareFiles)
            ->with('editableFiles' , $editableFiles)
            ->with('deptFiles' , $deptFiles)
            ->with('userTags' , $userTags)
            ;
    }

    public function myFiles() {
        $userFiles = FileRecord::with('user')
                               ->where('owner_id' , Auth::User()->id)
                               ->where('doc_type_id' , 1)
                               ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('userFiles' , $userFiles)
            ->with('userTags' , $userTags)
            ;
    }

    public function shared() {
        $shareFiles = FileRecord::with('user')
                                ->where('sharing' , 'LIKE' , "%" . Auth::User()->username . "%")
                                ->where('doc_type_id' , 1)
                                ->where('owner_id' , '!=' , Auth::User()->id)
                                ->get()
        ;
        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('shareFiles' , $shareFiles)
            ->with('userTags' , $userTags)
            ;
    }

    public function dept() {
        $deptFiles = FileRecord::with('user')
                               ->where('sharing' , 'LIKE' , "%" . Auth::User()->user_dept->name . "%")
                               ->where('doc_type_id' , 1)
                               ->where('owner_id' , '!=' , Auth::User()->id)
                               ->get()
        ;
        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('deptFiles' , $deptFiles)
            ->with('userTags' , $userTags)
            ;
    }

    public function org() {
        $orgFiles = FileRecord::with('user')
                              ->where('sharing' , 'LIKE' , "%\"mass\":\"1\"%")
                              ->where('doc_type_id' , 1)
                              ->where('owner_id' , '!=' , Auth::User()->id)
                              ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('orgFiles' , $orgFiles)
            ->with('userTags' , $userTags)
            ;
    }

    public function viewAchievements() {
        $userFiles = FileRecord::with('user')
                               ->where('owner_id' , Auth::User()->id)
                               ->where('doc_type_id' , 2)
                               ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('userFiles' , $userFiles)
            ->with('userTags' , $userTags)
            ;
    }

    public function getUnverified() {
        $userFiles = FileRecord::with('user')
                               ->with('achievements')
                               ->where('doc_type_id' , 2)
                               ->get()
        ;

        $userTags = $this->retrieveTags();
        $screen = "verify";

        return view('dashboard')
            ->with('userFiles' , $userFiles)
            ->with('userTags' , $userTags)
            ->with('screen' , $screen)
            ;
    }

    public function viewTag($tag) {
        $userFiles = FileRecord::with('user')
                               ->where('owner_id' , Auth::User()->id)
                               ->where('tags' , 'LIKE' , "%" . Auth::User()->username . "%")
                               ->where('tags' , 'LIKE' , "%" . $tag . "%")
                               ->get()
        ;
        $deptFiles = FileRecord::with('user')
                               ->where('sharing' , 'LIKE' , "%" . Auth::User()->user_dept->name . "%")
                               ->where('owner_id' , '!=' , Auth::User()->id)
                               ->where('tags' , 'LIKE' , "%" . Auth::User()->username . "%")
                               ->where('tags' , 'LIKE' , "%" . $tag . "%")
                               ->get()
        ;
        $orgFiles = FileRecord::with('user')
                              ->where('sharing' , 'LIKE' , "%\"mass\":\"1\"%")
                              ->where('owner_id' , '!=' , Auth::User()->id)
                              ->where('tags' , 'LIKE' , "%" . Auth::User()->username . "%")
                              ->where('tags' , 'LIKE' , "%" . $tag . "%")
                              ->get()
        ;
        $shareFiles = FileRecord::with('user')
                                ->where('sharing' , 'LIKE' , "%" . Auth::User()->username . "%")
                                ->where('owner_id' , '!=' , Auth::User()->id)
                                ->where('tags' , 'LIKE' , "%" . Auth::User()->username . "%")
                                ->where('tags' , 'LIKE' , "%" . $tag . "%")
                                ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('userFiles' , $userFiles)
            ->with('orgFiles' , $orgFiles)
            ->with('shareFiles' , $shareFiles)
            ->with('deptFiles' , $deptFiles)
            ->with('userTags' , $userTags)
            ;
    }

    private function retrieveTags() {
        $Tags = (array)json_decode(Auth::User()->user_tags);
        $userTags = [ ];

        foreach ($Tags as $tag) {
            $userTags[ $tag ] = $tag;
        }

        return $userTags;
    }

    public function search(Request $request) {
        $tag = $request->Tags[ 0 ];

        return redirect('/dashboard/tags/' . $tag);
    }
}

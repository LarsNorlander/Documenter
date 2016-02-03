<?php

namespace App\Http\Controllers;

use App\Department;
use App\FileRecord;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (Auth::check() && $request->user()->user_type_id == 1) {
            $allFiles = FileRecord::with('user')
                ->get();

            return View::make('admin.adminPanel')
                ->with('allFiles', $allFiles);
        } else
            return ("You are not authorized. Please fuck off :D");
    }

    public function depts(Request $request)
    {
        //
        if (Auth::check() && $request->user()->user_type_id == 1) {
            $allDepts = Department::get();

            return View::make('admin.adminPanel')
                ->with('allDepts', $allDepts);
        } else
            return ("You are not authorized. Please fuck off :D");
    }

    public function addDepts(Request $request)
    {
        //
        $name = $request->collegeName;
        $entry = new Department();
        $entry->name = $name;
        $entry->save();
        return redirect('/admin/depts');
    }

    public function delDepts($id)
    {
        //Delete stuff
        Department::destroy($id);
        return redirect('/admin/depts');
    }

}

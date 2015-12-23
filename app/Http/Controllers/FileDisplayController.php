<?php

namespace App\Http\Controllers;

use App\FileRecord;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileDisplayController extends Controller {
    //
    public function index()
    {
        $files = FileRecord::all();

        return view('files.dashboard', compact('files'));
    }
}

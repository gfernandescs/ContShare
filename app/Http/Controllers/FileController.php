<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\File;

class FileController extends Controller
{
    public function getGroups(){
    	$groups = File::distinct()->select('group')->where('cod_user', '=', 24)->groupBy('group')->get();
    	return view('groups',['groups' => $groups]);
    }

    public function getFiles($groups){
    	$files = File::all()->where('cod_user', 24)->where('group', $groups);
    	return view('files',['files' => $files]);
    }
}

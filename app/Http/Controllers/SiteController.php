<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Pref;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $genres=Genre::all();
        $prefs=Pref::all();
        return view('site.index',compact('genres','prefs'));
    }

    public function search(Request $request){
        dd($request);
    }
}

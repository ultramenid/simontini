<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapndataController extends Controller
{
    public function index(){
        $title = 'Map & Data - Simontini';
        $nav = 'map';
        return view('frontends.mapndata', compact('title', 'nav'));
    }
}

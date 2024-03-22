<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapndataController extends Controller
{
    public function index(){
        $title = 'Map & Data - Simontini';
        $nav = 'map';
        return view('frontends.mapndata', compact('title', 'nav'));
    }


}

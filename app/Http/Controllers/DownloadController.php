<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index(){
        $title = 'Downloads - Simontini';
        $nav = 'downloads';
        return view('frontends.downloads', compact('title', 'nav'));
    }
}

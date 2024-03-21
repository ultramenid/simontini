<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $title = 'Simontini - Homepage';
        $nav = 'index';
        return view('frontends.index', compact('title', 'nav'));
    }

}

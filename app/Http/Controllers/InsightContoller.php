<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsightContoller extends Controller
{
    public function stadi2024(){
        return view('frontends.stadi2024');
    }
    public function stadi2024EN(){
        return view('frontends.stadi2024EN');
    }
}

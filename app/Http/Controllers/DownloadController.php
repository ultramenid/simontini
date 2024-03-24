<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function getDescription(){
        if(app()->getLocale() == 'id'){
            return 'Peta & data tutupan lahan atau izin yang dapat diakses.';
        }else{
            return 'Access land cover or license maps and data.';
        }
    }
    public function index(){
        $title = 'Downloads - Simontini';
        $nav = 'downloads';
        $description= $this->getDescription();
        return view('frontends.downloads', compact('title', 'nav', 'description'));
    }
}

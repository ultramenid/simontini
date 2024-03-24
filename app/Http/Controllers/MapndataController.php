<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapndataController extends Controller
{
    public function getDescription(){
        if(app()->getLocale() == 'id'){
            return 'Memuat peta & data tutupan lahan dan izin.';
        }else{
            return 'Contains land cover and license maps and data.';
        }
    }
    public function index(){
        $title = 'Map & Data - Simontini';
        $nav = 'map';
        $description = $this->getDescription();
        return view('frontends.mapndata', compact('title', 'nav', 'description'));
    }


}

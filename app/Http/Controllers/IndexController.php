<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getDescription(){
        if(app()->getLocale() == 'id'){
            return 'Menyajikan data, informasi, dan analisis tutupan lahan dan izin di Indonesia.';
        }else{
            return 'Presenting data, information and analyses of land cover and licenses in Indonesia.';
        }
    }
    public function index(){
        $title = 'Simontini - Homepage';
        $description = $this->getDescription();
        $nav = 'index';
        return view('frontends.index', compact('title', 'nav', 'description'));
    }

}

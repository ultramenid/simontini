<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getDescription(){
        if(app()->getLocale() == 'id'){
            return 'Simontini oleh Auriga Nusantara menyajikan data, peta, dan analisis terbuka tentang deforestasi, tutupan lahan, serta izin konsesi di Indonesia.';
        }else{
            return 'Simontini by Auriga Nusantara presents open data, maps and analysis of deforestation, land cover and concession licenses across Indonesia.';
        }
    }
    public function index(){
        $title = app()->getLocale() === 'en'
            ? 'Simontini - Deforestation, Land Cover & License Data for Indonesia'
            : 'Simontini - Data Deforestasi, Tutupan Lahan & Izin di Indonesia';
        $description = $this->getDescription();
        $nav = 'index';
        $structuredData = [
            [
                '@type' => 'WebSite',
                'name' => 'Simontini',
                'alternateName' => 'Sistem Informasi Tutupan dan Izin di Indonesia',
                'url' => url('/'),
                'inLanguage' => ['id', 'en'],
                'publisher' => config('seo.organization'),
            ],
            config('seo.organization'),
        ];
        return view('frontends.index', compact('title', 'nav', 'description', 'structuredData'));
    }

}

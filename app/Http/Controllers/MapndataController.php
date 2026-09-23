<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapndataController extends Controller
{
    public function getDescription(){
        if(app()->getLocale() == 'id'){
            return 'Peta interaktif dan data tutupan lahan, deforestasi, serta izin konsesi (HGU, IUP, PBPH) di seluruh Indonesia dari Simontini, Auriga Nusantara.';
        }else{
            return 'Interactive map and data on land cover, deforestation and concession licenses (HGU, IUP, PBPH) across Indonesia from Simontini by Auriga Nusantara.';
        }
    }
    public function index(){
        $title = app()->getLocale() === 'en'
            ? 'Land Cover & License Map and Data for Indonesia - Simontini'
            : 'Peta & Data Tutupan Lahan dan Izin di Indonesia - Simontini';
        $nav = 'map';
        $description = $this->getDescription();
        $structuredData = [
            '@type' => 'Dataset',
            'name' => app()->getLocale() === 'en' ? 'Land cover and license map & data for Indonesia' : 'Peta & data tutupan lahan dan izin di Indonesia',
            'description' => $description,
            'url' => url()->current(),
            'isAccessibleForFree' => true,
            'spatialCoverage' => ['@type' => 'Place', 'name' => 'Indonesia'],
            'keywords' => ['deforestasi', 'deforestation', 'tutupan lahan', 'land cover', 'HGU', 'IUP', 'PBPH', 'kawasan hutan', 'Indonesia'],
            'creator' => config('seo.organization'),
            'publisher' => config('seo.organization'),
        ];
        return view('frontends.mapndata', compact('title', 'nav', 'description', 'structuredData'));
    }


}

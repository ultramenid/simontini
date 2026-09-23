<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function getDescription(){
        if(app()->getLocale() == 'id'){
            return 'Unduh data spasial dan laporan deforestasi, tutupan lahan, serta izin konsesi di Indonesia dari Simontini, Auriga Nusantara, secara terbuka dan gratis.';
        }else{
            return 'Download open spatial data and reports on deforestation, land cover and concession licenses in Indonesia from Simontini by Auriga Nusantara.';
        }
    }
    public function index(){
        $title = app()->getLocale() === 'en'
            ? 'Download Deforestation & License Data - Simontini'
            : 'Unduh Data Deforestasi & Izin - Simontini';
        $nav = 'downloads';
        $description= $this->getDescription();
        $structuredData = [
            '@type' => 'Dataset',
            'name' => app()->getLocale() === 'en' ? 'Indonesia deforestation data (STADI)' : 'Data deforestasi Indonesia (STADI)',
            'description' => $description,
            'url' => url()->current(),
            'isAccessibleForFree' => true,
            'spatialCoverage' => ['@type' => 'Place', 'name' => 'Indonesia'],
            'keywords' => ['deforestasi', 'deforestation', 'tutupan lahan', 'land cover', 'HGU', 'IUP', 'PBPH', 'kawasan hutan', 'Indonesia'],
            'creator' => config('seo.organization'),
            'publisher' => config('seo.organization'),
        ];
        return view('frontends.downloads', compact('title', 'nav', 'description', 'structuredData'));
    }
}

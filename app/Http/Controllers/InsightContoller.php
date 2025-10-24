<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsightContoller extends Controller
{

    public function index(){
        $title = 'Insight - Simontini';
        $nav = 'insight';
        $description = 'Simontini’s Insight is a series of articles that provide in-depth analysis of the latest issues related to deforestation and land use change in Indonesia.';
        return view('frontends.insight', compact('title', 'description', 'nav'));
    }
    public function stadi2024(){
        $title = 'Status deforestasi Indonesia 2024 ';
        $description = 'Tahun lalu Auriga merilis data deforestasi 2023 pada Maret. Mulai tahun ini, deforestasi tahunan akan dirilis setiap Januari.';
        return view('frontends.stadi2024', compact('title', 'description'));
    }
    public function stadi2024EN(){
        $title = 'Status of deforestation in Indonesia 2024 ';
        $description = 'Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.';
        return view('frontends.stadi2024EN', compact('title', 'description'));
    }
    public function stadi2024JP(){
        $title = 'Status of deforestation in Indonesia 2024 ';
        $description = 'Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.';
        return view('frontends.stadi2024JP', compact('title', 'description'));
    }
}

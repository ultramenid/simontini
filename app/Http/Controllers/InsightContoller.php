<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsightContoller extends Controller
{
    public function stadi2024(){
        $title = 'Deforestation 2024 - Simontini';
        $description = 'Tahun lalu Auriga merilis data deforestasi 2023 pada Maret. Mulai tahun ini, deforestasi tahunan akan dirilis setiap Januari.';
        return view('frontends.stadi2024', compact('title', 'description'));
    }
    public function stadi2024EN(){
        $title = 'Deforestation 2024 - Simontini';
        $description = 'Auriga released deforestation data for 2023 in March last year. Commencing this year, it will release annual deforestation data each January.';
        return view('frontends.stadi2024EN', compact('title', 'description'));
    }
}

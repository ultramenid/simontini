<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StadiController extends Controller
{
    public function stadi2025()
    {
        $title = 'Stadi 2025 - Simontini';
        $description = 'Stadi 2025 - Simontini';
        $nav = 'stadi';
        $noindex = true; // draft copy of the published STADI 2025 report
        return view('frontends.stadi.stadi2025', compact('title', 'description', 'nav', 'noindex'));
    }
}

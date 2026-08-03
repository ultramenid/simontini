<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard - Simontini';
        $nav = 'dashboard';

        return view('backends.dashboard', compact('title', 'nav'));
    }

    public function deforestory()
    {
        $title = 'Deforestory - Simontini';
        $nav = 'deforestory';

        return view('backends.deforestory', compact('title', 'nav'));
    }

    public function addDeforestory()
    {
        $title = 'Tambah Deforestory - Simontini';
        $nav = 'deforestory';

        return view('backends.deforestory-add', compact('title', 'nav'));
    }

    public function editDeforestory(int $id)
    {
        $title = 'Edit Deforestory - Simontini';
        $nav = 'deforestory';

        return view('backends.deforestory-edit', compact('title', 'nav', 'id'));
    }

    public function reference(Request $request)
    {
        $title = 'Reference Images - Simontini';
        $nav = 'reference';
        $picker = $request->boolean('picker');
        $editorKey = $request->string('editor')->toString();

        return view('backends.reference', compact('title', 'nav', 'picker', 'editorKey'));
    }
}

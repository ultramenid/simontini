<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function downloadReference(int $id)
    {
        $file = DB::table('reference_images')->find($id);
        abort_if($file === null, 404);

        $disk = $file->disk ?: 'public';
        abort_unless(Storage::disk($disk)->exists($file->image_path), 404);

        return Storage::disk($disk)->download(
            $file->image_path,
            $file->original_name ?: basename($file->image_path)
        );
    }
}

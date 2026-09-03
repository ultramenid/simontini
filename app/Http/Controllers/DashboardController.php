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
        $multiple = $request->boolean('multiple');
        $selectionLimit = max(0, $request->integer('limit'));
        $pickerPurpose = $request->string('purpose')->toString();
        $editorKey = $request->string('editor')->toString();
        $modal = $request->boolean('modal');

        return view('backends.reference', compact('title', 'nav', 'picker', 'multiple', 'selectionLimit', 'pickerPurpose', 'editorKey', 'modal'));
    }

    public function dataVisualizations()
    {
        $title = 'Data & Grafik - Simontini';
        $nav = 'data-visualizations';

        return view('backends.data-visualizations', compact('title', 'nav'));
    }

    public function addDataVisualization()
    {
        $title = 'Tambah Data & Grafik - Simontini';
        $nav = 'data-visualizations';
        $visualizationId = null;

        return view('backends.data-visualization-form', compact('title', 'nav', 'visualizationId'));
    }

    public function editDataVisualization(int $id)
    {
        abort_unless(DB::table('data_visualizations')->where('id', $id)->exists(), 404);

        $title = 'Edit Data & Grafik - Simontini';
        $nav = 'data-visualizations';
        $visualizationId = $id;

        return view('backends.data-visualization-form', compact('title', 'nav', 'visualizationId'));
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

    public function previewReference(int $id)
    {
        $file = DB::table('reference_images')->find($id);
        abort_if($file === null, 404);
        $mimeType = $file->mime_type ?: '';
        abort_unless(str_starts_with($mimeType, 'video/') || $mimeType === 'application/pdf', 404);

        $disk = $file->disk ?: 'public';
        abort_unless(Storage::disk($disk)->exists($file->image_path), 404);

        return Storage::disk($disk)->response(
            $file->image_path,
            $file->original_name ?: basename($file->image_path),
            ['Content-Type' => $mimeType],
            'inline'
        );
    }
}

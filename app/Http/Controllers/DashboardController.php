<?php

namespace App\Http\Controllers;

use App\Services\CommentHtmlSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard - Simontini';
        $nav = 'dashboard';

        $stats = [
            'stories' => DB::table('deforestory')->count(),
            'published' => DB::table('deforestory')->where('status', 'publish')->count(),
            'drafts' => DB::table('deforestory')->where('status', 'draft')->count(),
            'locked' => DB::table('deforestory')->where('is_locked', true)->count(),
            'comments' => DB::table('story_comments')->count(),
            'hiddenComments' => DB::table('story_comments')->where('status', 'hidden')->count(),
            'subscribers' => DB::table('deforestation_story_subscriptions')->where('status', 'active')->count(),
            'visualizations' => DB::table('data_visualizations')->where('is_active', true)->count(),
            'references' => DB::table('reference_images')->count(),
        ];

        $recentStories = DB::table('deforestory')
            ->select(['id', 'title_id', 'status', 'is_locked', 'updated_at'])
            ->orderByDesc('updated_at')
            ->limit(5)
            ->get();

        $recentComments = DB::table('story_comments as comments')
            ->join('deforestory as stories', 'stories.id', '=', 'comments.story_id')
            ->select(['comments.user_name', 'comments.comment', 'comments.status', 'comments.created_at', 'stories.title_id as story_title'])
            ->orderByDesc('comments.created_at')
            ->limit(5)
            ->get()
            ->each(function (object $comment): void {
                $sanitizer = app(CommentHtmlSanitizer::class);
                $comment->comment = $sanitizer->plainText($sanitizer->sanitize($comment->comment));
            });

        return view('backends.dashboard', compact('title', 'nav', 'stats', 'recentStories', 'recentComments'));
    }

    public function users()
    {
        $title = 'User - Simontini';
        $nav = 'users';

        return view('backends.users', compact('title', 'nav'));
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

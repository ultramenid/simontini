<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CmsCommentController extends Controller
{
    public function index(): View
    {
        $comments = DB::table('story_comments')
            ->orderByRaw("CASE status WHEN 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('created_at')
            ->limit(250)
            ->get()
            ->map(fn (object $comment): array => (array) $comment);

        return view('backends.comments', [
            'title' => 'Komentar - Simontini',
            'nav' => 'comments',
            'comments' => $comments,
        ]);
    }

    public function status(int $id, string $status): RedirectResponse
    {
        abort_unless(in_array($status, ['approved', 'rejected', 'spam'], true), 404);

        DB::table('story_comments')->where('id', $id)->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

        return back()->with('message', 'Status komentar berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        DB::table('story_comments')->where('id', $id)->delete();

        return back()->with('message', 'Komentar berhasil dihapus.');
    }
}

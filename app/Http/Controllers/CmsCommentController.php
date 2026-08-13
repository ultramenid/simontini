<?php

namespace App\Http\Controllers;

use App\Jobs\SendStoryCommentReplyNotificationEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsCommentController extends Controller
{
    public function index(Request $request): View
    {
        $requestedStoryId = $request->integer('story_id');
        $selectedStoryId = $requestedStoryId > 0
            && DB::table('deforestory')->where('id', $requestedStoryId)->exists()
                ? $requestedStoryId
                : null;

        $commentsQuery = DB::table('story_comments as comments')
            ->join('deforestory as stories', 'stories.id', '=', 'comments.story_id')
            ->select([
                'comments.*',
                'stories.title_id as story_title_id',
                'stories.title_en as story_title_en',
                'stories.slug as story_slug',
            ]);

        if ($selectedStoryId !== null) {
            $commentsQuery->where('comments.story_id', $selectedStoryId);
        }

        $comments = $commentsQuery
            ->orderByRaw("CASE comments.status WHEN 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('comments.created_at')
            ->limit(250)
            ->get()
            ->map(fn (object $comment): array => (array) $comment);

        $stories = DB::table('deforestory as stories')
            ->leftJoin('story_comments as comments', 'comments.story_id', '=', 'stories.id')
            ->select([
                'stories.id',
                'stories.title_id',
                'stories.title_en',
            ])
            ->selectRaw('COUNT(comments.id) as comments_count')
            ->groupBy('stories.id', 'stories.title_id', 'stories.title_en')
            ->orderBy('stories.title_id')
            ->get();

        $totalComments = (int) DB::table('story_comments')->count();
        $commentUsers = DB::table('comment_users as users')
            ->leftJoin('story_comments as comments', 'comments.comment_user_id', '=', 'users.id')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.provider',
                'users.last_login_at',
            ])
            ->selectRaw('COUNT(comments.id) as comments_count')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.provider', 'users.last_login_at')
            ->orderByDesc('users.last_login_at')
            ->get();

        return view('backends.comments', [
            'title' => 'Komentar - Simontini',
            'nav' => 'comments',
            'comments' => $comments,
            'stories' => $stories,
            'selectedStoryId' => $selectedStoryId,
            'totalComments' => $totalComments,
            'commentUsers' => $commentUsers,
        ]);
    }

    public function status(int $id, string $status): RedirectResponse
    {
        abort_unless(in_array($status, ['approved', 'rejected', 'spam'], true), 404);

        $comment = DB::table('story_comments')
            ->select(['id', 'parent_id', 'status'])
            ->where('id', $id)
            ->first();
        abort_unless($comment, 404);

        $statusChanged = $status === 'approved'
            ? DB::table('story_comments')
                ->where('id', $id)
                ->where('status', '!=', 'approved')
                ->update([
                    'status' => $status,
                    'updated_at' => now(),
                ]) === 1
            : DB::table('story_comments')
                ->where('id', $id)
                ->update([
                    'status' => $status,
                    'updated_at' => now(),
                ]) === 1;

        if (
            $status === 'approved'
            && $statusChanged
            && $comment->parent_id !== null
        ) {
            SendStoryCommentReplyNotificationEmail::dispatchAfterResponse((int) $comment->id);
        }

        return back()->with('message', 'Status komentar berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        DB::table('story_comments')->where('id', $id)->delete();

        return back()->with('message', 'Komentar berhasil dihapus.');
    }
}

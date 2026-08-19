<?php

namespace App\Http\Controllers;

use App\Jobs\SendStoryCommentReplyNotificationEmail;
use App\Services\CommentHtmlSanitizer;
use App\Services\TurnstileVerifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StoryCommentController extends Controller
{
    public function store(Request $request, string $locale, int $id, TurnstileVerifier $turnstile, CommentHtmlSanitizer $sanitizer): RedirectResponse|JsonResponse
    {
        $story = DB::table('deforestory')
            ->select(['id', 'slug'])
            ->where('id', $id)
            ->where('status', 'publish')
            ->first();
        abort_unless($story, 404);

        $commentsUrl = route('deforestation.show', [
            'locale' => $locale,
            'id' => $story->id,
            'slug' => $story->slug,
        ]);

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:5000'],
            'parent_id' => ['nullable', 'integer', 'min:1'],
            'display_name' => ['required', 'string', 'min:2', 'max:60'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'anonymous' => ['nullable', 'boolean'],
            'cf-turnstile-response' => ['required', 'string', 'max:2048'],
        ]);

        if (! $turnstile->verify($validated['cf-turnstile-response'], $request->ip())) {
            throw ValidationException::withMessages([
                'cf-turnstile-response' => $locale === 'en'
                    ? 'Security verification failed. Please try again.'
                    : 'Verifikasi keamanan gagal. Silakan coba lagi.',
            ]);
        }

        $safeComment = $sanitizer->sanitize($validated['comment']);
        $plainComment = $sanitizer->plainText($safeComment);

        if (mb_strlen($plainComment) < 2 || mb_strlen($plainComment) > 2000) {
            throw ValidationException::withMessages([
                'comment' => $locale === 'en'
                    ? 'The comment must contain between 2 and 2000 characters.'
                    : 'Komentar harus berisi antara 2 sampai 2000 karakter.',
            ]);
        }

        $displayName = trim($validated['display_name']);
        $email = mb_strtolower(trim($validated['email']));
        $emailIdentity = hash('sha256', $email);
        $publicDisplayName = $request->boolean('anonymous') ? 'Anonymous' : $displayName;

        $request->session()->put('comment_display_name', $displayName);
        $request->session()->put('comment_email', $email);
        $request->session()->put('comment_user', [
            'provider' => 'email',
            'id' => $emailIdentity,
            'name' => $displayName,
            'email' => $email,
            'avatar' => null,
        ]);

        $commentUser = DB::table('comment_users')
            ->where('provider', 'email')
            ->where('provider_user_id', $emailIdentity)
            ->first();

        if ($commentUser) {
            $commentUserId = $commentUser->id;
            DB::table('comment_users')->where('id', $commentUserId)->update([
                'name' => $displayName,
                'email' => $email,
                'last_login_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $commentUserId = DB::table('comment_users')->insertGetId([
                'provider' => 'email',
                'provider_user_id' => $emailIdentity,
                'name' => $displayName,
                'email' => $email,
                'avatar' => null,
                'last_login_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentId = $validated['parent_id'] ?? null;
        if ($parentId !== null) {
            $storyComments = DB::table('story_comments')
                ->where('story_id', $id)
                ->where('status', 'approved')
                ->get(['id', 'parent_id'])
                ->keyBy(fn (object $comment): int => (int) $comment->id);

            $parentDepth = 0;
            $currentId = $parentId;
            $visited = [];

            while ($currentId !== null) {
                if (isset($visited[$currentId]) || ! $storyComments->has($currentId)) {
                    throw ValidationException::withMessages([
                        'parent_id' => $locale === 'en'
                            ? 'The selected parent comment is invalid.'
                            : 'Komentar induk yang dipilih tidak valid.',
                    ]);
                }

                $visited[$currentId] = true;
                $parent = $storyComments->get($currentId);
                $currentId = $parent->parent_id === null ? null : (int) $parent->parent_id;

                if ($currentId !== null) {
                    $parentDepth++;
                }
            }

            if ($parentDepth >= 3) {
                throw ValidationException::withMessages([
                    'parent_id' => $locale === 'en'
                        ? 'This reply has reached the maximum reply depth.'
                        : 'Balasan ini sudah mencapai tingkat balasan terakhir.',
                ]);
            }
        }

        $commentId = DB::table('story_comments')->insertGetId([
            'story_id' => $id,
            'parent_id' => $parentId,
            'comment_user_id' => $commentUserId,
            'user_provider' => 'email',
            'user_id' => $emailIdentity,
            'user_name' => $publicDisplayName,
            'user_email' => $email,
            'user_avatar' => null,
            'comment' => $safeComment,
            'status' => 'approved',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($parentId !== null) {
            SendStoryCommentReplyNotificationEmail::dispatchAfterResponse($commentId);
        }

        $successMessage = $locale === 'en'
            ? 'Your comment was published successfully.'
            : 'Komentar berhasil diterbitkan.';
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $successMessage,
                'comment_id' => $commentId,
                'parent_id' => $parentId,
            ], 201);
        }

        return redirect()->to($commentsUrl)->with('comment_success', $successMessage);
    }
}

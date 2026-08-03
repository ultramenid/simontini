<?php

namespace App\Http\Controllers;

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
        ]).'?comment=sent#comments';

        $user = $request->session()->get('comment_user');
        if (! is_array($user) || empty($user['id']) || empty($user['email'])) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $locale === 'en'
                        ? 'Please sign in with Google before commenting.'
                        : 'Silakan masuk dengan Google sebelum berkomentar.',
                ], 401);
            }

            return back()->with('comment_error', $locale === 'en'
                ? 'Please sign in with Google before commenting.'
                : 'Silakan masuk dengan Google sebelum berkomentar.');
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:5000'],
            'parent_id' => ['nullable', 'integer', 'min:1'],
            'display_name' => ['required_unless:anonymous,1', 'nullable', 'string', 'min:2', 'max:60'],
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

        $isAnonymous = $request->boolean('anonymous');
        $displayName = $isAnonymous ? 'Anonymous' : trim($validated['display_name']);

        if (! $isAnonymous) {
            $request->session()->put('comment_display_name', $displayName);
        }

        $commentUser = DB::table('comment_users')
            ->where('provider', $user['provider'] ?? 'google')
            ->where('provider_user_id', (string) $user['id'])
            ->first();

        if ($commentUser) {
            $commentUserId = $commentUser->id;
        } else {
            $commentUserId = DB::table('comment_users')->insertGetId([
                'provider' => $user['provider'] ?? 'google',
                'provider_user_id' => (string) $user['id'],
                'name' => (string) ($user['name'] ?? 'Pengguna Google'),
                'email' => (string) $user['email'],
                'avatar' => $user['avatar'] ?? null,
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

        DB::table('story_comments')->insert([
            'story_id' => $id,
            'parent_id' => $parentId,
            'comment_user_id' => $commentUserId,
            'user_provider' => $user['provider'] ?? 'google',
            'user_id' => (string) $user['id'],
            'user_name' => $displayName,
            'user_email' => (string) $user['email'],
            'user_avatar' => $isAnonymous ? null : ($user['avatar'] ?? null),
            'comment' => $safeComment,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $successMessage = $locale === 'en'
            ? 'Your comment was submitted and is waiting for moderation.'
            : 'Komentar berhasil dikirim dan sedang menunggu moderasi.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $successMessage], 201);
        }

        return redirect()->to($commentsUrl)->with('comment_success', $successMessage);
    }
}

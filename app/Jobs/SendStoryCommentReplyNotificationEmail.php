<?php

namespace App\Jobs;

use App\Mail\StoryCommentReplyNotification;
use App\Services\CommentHtmlSanitizer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendStoryCommentReplyNotificationEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(public int $replyId) {}

    public function handle(CommentHtmlSanitizer $sanitizer): void
    {
        $notificationKey = self::notificationCacheKey($this->replyId);

        if (Cache::has($notificationKey)) {
            return;
        }

        $lock = Cache::lock($notificationKey.':lock', 120);

        if (! $lock->get()) {
            return;
        }

        try {
            if (Cache::has($notificationKey)) {
                return;
            }

            $this->sendNotification($sanitizer, $notificationKey);
        } finally {
            $lock->release();
        }
    }

    private function sendNotification(CommentHtmlSanitizer $sanitizer, string $notificationKey): void
    {
        $reply = DB::table('story_comments as replies')
            ->join('story_comments as parents', 'parents.id', '=', 'replies.parent_id')
            ->join('deforestory as stories', 'stories.id', '=', 'replies.story_id')
            ->where('replies.id', $this->replyId)
            ->where('replies.status', 'approved')
            ->select([
                'replies.id',
                'replies.user_provider as reply_user_provider',
                'replies.user_id as reply_user_id',
                'replies.user_name as reply_user_name',
                'replies.comment as reply_comment',
                'parents.user_provider as parent_user_provider',
                'parents.user_id as parent_user_id',
                'parents.user_name as parent_user_name',
                'parents.user_email as parent_user_email',
                'parents.comment as parent_comment',
                'stories.id as story_id',
                'stories.slug as story_slug',
                'stories.title_id',
                'stories.title_en',
            ])
            ->first();

        if (! $reply || blank($reply->parent_user_email)) {
            return;
        }

        if (
            $reply->reply_user_provider === $reply->parent_user_provider
            && (string) $reply->reply_user_id === (string) $reply->parent_user_id
        ) {
            return;
        }

        Mail::to($reply->parent_user_email, $reply->parent_user_name)->send(
            new StoryCommentReplyNotification([
                'recipientName' => $reply->parent_user_name,
                'replyAuthor' => $reply->reply_user_name,
                'originalComment' => $sanitizer->plainText($reply->parent_comment),
                'replyComment' => $sanitizer->plainText($reply->reply_comment),
                'storyTitleId' => $reply->title_id ?: $reply->title_en,
                'storyTitleEn' => $reply->title_en ?: $reply->title_id,
                'urlId' => route('deforestation.show', [
                    'locale' => 'id',
                    'id' => $reply->story_id,
                    'slug' => $reply->story_slug,
                ]).'#comments',
                'urlEn' => route('deforestation.show', [
                    'locale' => 'en',
                    'id' => $reply->story_id,
                    'slug' => $reply->story_slug,
                ]).'#comments',
            ]),
        );

        Cache::forever($notificationKey, true);
    }

    public static function notificationCacheKey(int $replyId): string
    {
        return 'story-comment-reply-notification:'.$replyId;
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Gagal mengirim notifikasi balasan komentar.', [
            'reply_id' => $this->replyId,
            'error' => $exception?->getMessage() ?? 'Unknown queue error',
        ]);
    }
}

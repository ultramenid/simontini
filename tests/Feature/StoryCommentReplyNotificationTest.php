<?php

use App\Http\Controllers\CmsCommentController;
use App\Jobs\SendStoryCommentReplyNotificationEmail;
use App\Mail\StoryCommentReplyNotification;
use App\Services\CommentHtmlSanitizer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;

uses(DatabaseTransactions::class);

function createCommentReplyFixture(bool $sameUser = false): array
{
    $storyId = DB::table('deforestory')->insertGetId([
        'external_id' => null,
        'uuid' => (string) Str::uuid(),
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Cerita Komentar',
        'title_en' => 'Comment Story',
        'slug' => 'cerita-komentar-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-11',
        'content_id' => '<p>Konten</p>',
        'content_en' => '<p>Content</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $parentId = DB::table('story_comments')->insertGetId([
        'story_id' => $storyId,
        'parent_id' => null,
        'comment_user_id' => null,
        'user_provider' => 'google',
        'user_id' => 'parent-google-id',
        'user_name' => 'Pemilik Komentar',
        'user_email' => 'parent@example.test',
        'user_avatar' => null,
        'comment' => '<p>Komentar <strong>awal</strong>.</p>',
        'status' => 'approved',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $replyId = DB::table('story_comments')->insertGetId([
        'story_id' => $storyId,
        'parent_id' => $parentId,
        'comment_user_id' => null,
        'user_provider' => 'google',
        'user_id' => $sameUser ? 'parent-google-id' : 'reply-google-id',
        'user_name' => $sameUser ? 'Pemilik Komentar' : 'Pemberi Balasan',
        'user_email' => $sameUser ? 'parent@example.test' : 'reply@example.test',
        'user_avatar' => null,
        'comment' => '<p>Ini <em>balasannya</em>.</p>',
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return compact('storyId', 'parentId', 'replyId');
}

it('queues a reply notification when a reply is approved for the first time', function () {
    Queue::fake();
    ['replyId' => $replyId] = createCommentReplyFixture();

    $this->withSession(['id' => 1])
        ->patch(route('cms.comments.status', ['id' => $replyId, 'status' => 'approved']))
        ->assertRedirect();

    Queue::assertPushed(SendStoryCommentReplyNotificationEmail::class, fn ($job) => $job->replyId === $replyId);
    Queue::assertPushed(SendStoryCommentReplyNotificationEmail::class, 1);
    expect(DB::table('story_comments')->where('id', $replyId)->value('status'))->toBe('approved');

    app(CmsCommentController::class)->status($replyId, 'approved');

    Queue::assertPushed(SendStoryCommentReplyNotificationEmail::class, 1);
});

it('sends a bilingual email to the parent comment owner', function () {
    Mail::fake();
    ['replyId' => $replyId] = createCommentReplyFixture();
    DB::table('story_comments')->where('id', $replyId)->update(['status' => 'approved']);

    (new SendStoryCommentReplyNotificationEmail($replyId))->handle(app(CommentHtmlSanitizer::class));

    Mail::assertSent(StoryCommentReplyNotification::class, function (StoryCommentReplyNotification $mail): bool {
        return $mail->hasTo('parent@example.test')
            && $mail->mailData['originalComment'] === 'Komentar awal.'
            && $mail->mailData['replyComment'] === 'Ini balasannya.'
            && str_ends_with($mail->mailData['urlId'], '#comments')
            && str_ends_with($mail->mailData['urlEn'], '#comments');
    });

    expect(DB::table('story_comments')->where('id', $replyId)->value('reply_notification_sent_at'))->not->toBeNull();
});

it('does not email users when they reply to their own comment', function () {
    Mail::fake();
    ['replyId' => $replyId] = createCommentReplyFixture(true);
    DB::table('story_comments')->where('id', $replyId)->update(['status' => 'approved']);

    (new SendStoryCommentReplyNotificationEmail($replyId))->handle(app(CommentHtmlSanitizer::class));

    Mail::assertNothingSent();
});

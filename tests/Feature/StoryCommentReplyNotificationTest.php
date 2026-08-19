<?php

use App\Jobs\SendStoryCommentReplyNotificationEmail;
use App\Mail\StoryCommentReplyNotification;
use App\Services\CommentHtmlSanitizer;
use App\Services\TurnstileVerifier;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
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

    Cache::forget(SendStoryCommentReplyNotificationEmail::notificationCacheKey($replyId));

    return compact('storyId', 'parentId', 'replyId');
}

it('publishes a reply immediately and queues its notification after submission', function () {
    Queue::fake();
    ['storyId' => $storyId, 'parentId' => $parentId, 'replyId' => $fixtureReplyId] = createCommentReplyFixture();
    DB::table('story_comments')->where('id', $fixtureReplyId)->delete();

    $turnstile = Mockery::mock(TurnstileVerifier::class);
    $turnstile->shouldReceive('verify')->once()->andReturnTrue();
    app()->instance(TurnstileVerifier::class, $turnstile);

    $this->postJson(route('deforestation.comments.store', [
        'locale' => 'id',
        'id' => $storyId,
    ]), [
        'parent_id' => $parentId,
        'display_name' => 'Pemberi Balasan',
        'email' => 'reply@example.test',
        'comment' => '<p>Balasan langsung tampil.</p>',
        'cf-turnstile-response' => 'valid-turnstile-token',
    ])->assertCreated()
        ->assertJsonPath('message', 'Komentar berhasil diterbitkan.')
        ->assertJsonPath('comment_id', fn (int $id): bool => $id > 0)
        ->assertJsonPath('parent_id', $parentId)
        ->assertJsonMissingPath('redirect_url');

    $replyId = (int) DB::table('story_comments')
        ->where('parent_id', $parentId)
        ->where('user_email', 'reply@example.test')
        ->value('id');

    Queue::assertPushed(SendStoryCommentReplyNotificationEmail::class, fn ($job) => $job->replyId === $replyId);
    Queue::assertPushed(SendStoryCommentReplyNotificationEmail::class, 1);
    expect(DB::table('story_comments')->where('id', $replyId)->value('status'))->toBe('approved');
});

it('requires an email and stores a guest comment without exposing the email publicly', function () {
    ['storyId' => $storyId] = createCommentReplyFixture();

    $turnstile = Mockery::mock(TurnstileVerifier::class);
    $turnstile->shouldReceive('verify')->once()->andReturnTrue();
    app()->instance(TurnstileVerifier::class, $turnstile);

    $route = route('deforestation.comments.store', [
        'locale' => 'id',
        'id' => $storyId,
    ]);

    $this->postJson($route, [
        'display_name' => 'Komentator Tamu',
        'comment' => '<p>Komentar tanpa email.</p>',
        'cf-turnstile-response' => 'valid-turnstile-token',
    ])->assertUnprocessable()->assertJsonValidationErrors('email');

    $this->postJson($route, [
        'display_name' => 'Komentator Tamu',
        'email' => 'Guest.Comment@Example.test',
        'comment' => '<p>Komentar dengan email wajib.</p>',
        'cf-turnstile-response' => 'valid-turnstile-token',
    ])->assertCreated();

    $this->assertDatabaseHas('story_comments', [
        'story_id' => $storyId,
        'user_provider' => 'email',
        'user_id' => hash('sha256', 'guest.comment@example.test'),
        'user_name' => 'Komentator Tamu',
        'user_email' => 'guest.comment@example.test',
        'status' => 'approved',
    ]);
    $this->assertDatabaseHas('comment_users', [
        'provider' => 'email',
        'provider_user_id' => hash('sha256', 'guest.comment@example.test'),
        'email' => 'guest.comment@example.test',
    ]);

    $this->flushSession();
    $story = DB::table('deforestory')->where('id', $storyId)->first();
    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $storyId,
        'slug' => $story->slug,
    ]))->assertOk()
        ->assertSee('Komentar dengan email wajib.')
        ->assertDontSee('guest.comment@example.test');
});

it('stores the required email while publishing the selected identity as anonymous', function () {
    ['storyId' => $storyId] = createCommentReplyFixture();

    $turnstile = Mockery::mock(TurnstileVerifier::class);
    $turnstile->shouldReceive('verify')->once()->andReturnTrue();
    app()->instance(TurnstileVerifier::class, $turnstile);

    $this->postJson(route('deforestation.comments.store', [
        'locale' => 'id',
        'id' => $storyId,
    ]), [
        'display_name' => 'Nama Asli',
        'email' => 'Nama.Asli@Example.test',
        'anonymous' => '1',
        'comment' => '<p>Komentar privat.</p>',
        'cf-turnstile-response' => 'valid-turnstile-token',
    ])->assertCreated();

    $this->assertDatabaseHas('story_comments', [
        'story_id' => $storyId,
        'user_name' => 'Anonymous',
        'user_email' => 'nama.asli@example.test',
        'status' => 'approved',
    ]);
    $this->assertDatabaseHas('comment_users', [
        'name' => 'Nama Asli',
        'email' => 'nama.asli@example.test',
    ]);

    $this->flushSession();
    $story = DB::table('deforestory')->where('id', $storyId)->first();
    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $storyId,
        'slug' => $story->slug,
    ]))->assertOk()
        ->assertSee('Anonim')
        ->assertDontSee('Nama Asli')
        ->assertDontSee('nama.asli@example.test');
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

    expect(Cache::has(SendStoryCommentReplyNotificationEmail::notificationCacheKey($replyId)))->toBeTrue();
});

it('does not email users when they reply to their own comment', function () {
    Mail::fake();
    ['replyId' => $replyId] = createCommentReplyFixture(true);
    DB::table('story_comments')->where('id', $replyId)->update(['status' => 'approved']);

    (new SendStoryCommentReplyNotificationEmail($replyId))->handle(app(CommentHtmlSanitizer::class));

    Mail::assertNothingSent();
});

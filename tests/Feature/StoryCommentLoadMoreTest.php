<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Livewire;
use App\Livewire\DeforestationStoryInteractions;

uses(DatabaseTransactions::class);

it('refreshes comments without requesting Pasopati reports again', function () {
    $story = DB::table('deforestory')->whereNotNull('uuid')->first(['id', 'uuid']);

    expect($story)->not->toBeNull();

    config(['services.deforestory.webhook_url' => 'https://pasopati.test/api']);
    Http::fake([
        "https://pasopati.test/api/deforestory/by-uuid/laporan/{$story->uuid}" => Http::response([
            [
                'external_id' => 'report-once',
                'title_id' => 'Pembaruan Sekali Muat',
                'title_en' => 'Loaded Once Update',
                'description_id' => 'Deskripsi pembaruan.',
                'description_en' => 'Update description.',
                'image_url' => 'https://pasopati.test/images/update.jpg',
                'target_url_id' => 'https://pasopati.test/id/update',
                'target_url_en' => 'https://pasopati.test/en/update',
                'published_at' => '2026-08-19',
                'status' => 'on',
            ],
        ]),
    ]);

    Livewire::test(DeforestationStoryInteractions::class, [
        'storyId' => (int) $story->id,
        'storyUuid' => $story->uuid,
        'locale' => 'id',
        'isPreview' => false,
    ])
        ->assertSee('Pembaruan Sekali Muat')
        ->dispatch('comment-created', commentId: 999)
        ->assertSee('Pembaruan Sekali Muat');

    Http::assertSentCount(1);
});

it('shows five main comments first and loads five more per click through the load more control', function () {
    Http::fake();

    $storyId = DB::table('deforestory')->insertGetId([
        'external_id' => null,
        'uuid' => (string) Str::uuid(),
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Cerita dengan Komentar',
        'title_en' => 'Story with Comments',
        'slug' => 'cerita-dengan-komentar-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-12',
        'content_id' => '<p>Konten</p>',
        'content_en' => '<p>Content</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach (range(1, 15) as $number) {
        DB::table('story_comments')->insert([
            'story_id' => $storyId,
            'parent_id' => null,
            'comment_user_id' => null,
            'user_provider' => 'google',
            'user_id' => 'comment-user-'.$number,
            'user_name' => 'Komentator '.$number,
            'user_email' => 'comment-'.$number.'@example.test',
            'user_avatar' => null,
            'comment' => '<p>Komentar utama '.$number.'</p>',
            'status' => 'approved',
            'created_at' => now()->addSeconds($number),
            'updated_at' => now(),
        ]);
    }

    $response = $this->get(route('deforestation.show', [
            'locale' => 'id',
            'id' => $storyId,
            'slug' => DB::table('deforestory')->where('id', $storyId)->value('slug'),
        ]));

    $response
        ->assertOk()
        ->assertSee('visibleMainComments: 5', false)
        ->assertSee('totalMainComments: 15', false)
        ->assertSee('visibleMainComments + 5', false)
        ->assertSee('data-main-comment-index="14"', false)
        ->assertSee('Lihat komentar lainnya')
        ->assertSee('data-floating-comment-composer', false)
        ->assertSee('Tulis komentar')
        ->assertSee('Apa pendapat Anda?')
        ->assertSee('Nama *')
        ->assertSee('Email *')
        ->assertSee('Wajib diisi dan tidak ditampilkan ke publik.')
        ->assertSee('x-show="!turnstilePassed"', false)
        ->assertSee('data-comment-turnstile', false)
        ->assertSee('data-action="comment"', false)
        ->assertSee('render=explicit&amp;onload=initializeCommentTurnstiles', false)
        ->assertSee('x-on:comment-submitted.window="if (!$event.detail.quick) { turnstilePassed = false; expanded = false }"', false)
        ->assertDontSee('Lanjutkan dengan Google')
        ->assertDontSee('Terverifikasi dengan Google')
        ->assertSeeInOrder([
            'Komentar utama 15',
            'Komentar utama 14',
            'Komentar utama 13',
        ]);
});

it('shows name and required email fields when a guest replies', function () {
    Http::fake();
    $storyId = DB::table('deforestory')->insertGetId([
        'external_id' => null,
        'uuid' => (string) Str::uuid(),
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Story Login Balasan',
        'title_en' => 'Reply Login Story',
        'slug' => 'story-login-balasan-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-13',
        'content_id' => '<p>Konten</p>',
        'content_en' => '<p>Content</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $commentId = DB::table('story_comments')->insertGetId([
        'story_id' => $storyId,
        'parent_id' => null,
        'comment_user_id' => null,
        'user_provider' => 'google',
        'user_id' => 'guest-reply-owner',
        'user_name' => 'Pemilik Komentar',
        'user_email' => 'comment-owner@example.test',
        'user_avatar' => null,
        'comment' => '<p>Komentar untuk dibalas.</p>',
        'status' => 'approved',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $storyId,
        'slug' => DB::table('deforestory')->where('id', $storyId)->value('slug'),
    ]));

    $response
        ->assertOk()
        ->assertSee('data-comment-reply-toggle="'.$commentId.'"', false)
        ->assertSee('data-comment-reply-panel="'.$commentId.'"', false)
        ->assertSee('name="display_name"', false)
        ->assertSee('data-quick-comment-form', false)
        ->assertSee('name="email"', false)
        ->assertSee('Wajib diisi. Email tidak akan dipublikasikan.')
        ->assertDontSee('Lanjutkan dengan Google');
});

it('lets the CMS hide and restore a published comment without deleting it', function () {
    Http::fake();

    $storyId = DB::table('deforestory')->insertGetId([
        'external_id' => null,
        'uuid' => (string) Str::uuid(),
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Story Moderasi Komentar',
        'title_en' => 'Comment Moderation Story',
        'slug' => 'story-moderasi-komentar-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-13',
        'content_id' => '<p>Konten</p>',
        'content_en' => '<p>Content</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $commentId = DB::table('story_comments')->insertGetId([
        'story_id' => $storyId,
        'parent_id' => null,
        'comment_user_id' => null,
        'user_provider' => 'google',
        'user_id' => 'moderation-user',
        'user_name' => 'Pengguna Moderasi',
        'user_email' => 'moderation@example.test',
        'user_avatar' => null,
        'comment' => '<p>Komentar moderasi unik.</p>',
        'status' => 'approved',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $storyUrl = route('deforestation.show', [
        'locale' => 'id',
        'id' => $storyId,
        'slug' => DB::table('deforestory')->where('id', $storyId)->value('slug'),
    ]);

    $this->get($storyUrl)->assertOk()->assertSee('Komentar moderasi unik.');

    $this->withSession(['id' => 1])
        ->patch(route('cms.comments.status', ['id' => $commentId, 'status' => 'hidden']))
        ->assertRedirect();

    $this->assertDatabaseHas('story_comments', [
        'id' => $commentId,
        'status' => 'hidden',
    ]);
    $this->get($storyUrl)->assertOk()->assertDontSee('Komentar moderasi unik.');

    $this->withSession(['id' => 1])
        ->patch(route('cms.comments.status', ['id' => $commentId, 'status' => 'approved']))
        ->assertRedirect();

    $this->assertDatabaseHas('story_comments', [
        'id' => $commentId,
        'status' => 'approved',
    ]);
    $this->get($storyUrl)->assertOk()->assertSee('Komentar moderasi unik.');
});

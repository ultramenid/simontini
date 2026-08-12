<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

uses(DatabaseTransactions::class);

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

    $response = $this
        ->withSession([
            'comment_user' => [
                'provider' => 'google',
                'id' => 'floating-comment-user',
                'name' => 'Pengguna Komentar',
                'email' => 'floating-comment@example.test',
            ],
        ])
        ->get(route('deforestation.show', [
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
        ->assertSee('data-quick-comment-form', false)
        ->assertSee('quick-comment-editor', false)
        ->assertSee('quickCommentTurnstileSuccess', false)
        ->assertSee('Apa pendapat Anda?')
        ->assertSee('Pengguna Komentar')
        ->assertSee('Terverifikasi dengan Google')
        ->assertSee('x-show="!turnstilePassed"', false)
        ->assertSee('Tampilkan sebagai Anonymous');
});

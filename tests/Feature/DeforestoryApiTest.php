<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

it('rejects a deforestory post without a valid token', function () {
    config(['services.deforestory.api_token' => 'test-token']);

    $this->postJson('/api/deforestory', [])
        ->assertUnauthorized()
        ->assertJsonPath('message', 'API token tidak valid.');
});

it('creates deforestory data using a valid bearer token', function () {
    config(['services.deforestory.api_token' => 'test-token']);

    $payload = [
        'title_id' => 'Judul API Indonesia',
        'title_en' => 'English API Title',
        'desrkirpsi_id' => 'Deskripsi API Indonesia',
        'desrkirpsi_en' => 'English API description',
        'date' => '2026-07-31',
        'content_id' => 'Konten API Indonesia',
        'content_en' => 'English API content',
        'status' => 'publish',
    ];

    $this->withToken('test-token')
        ->postJson('/api/deforestory', $payload)
        ->assertCreated()
        ->assertJsonPath('message', 'Data Deforestory berhasil dibuat.')
        ->assertJsonPath('data.title_id', 'Judul API Indonesia')
        ->assertJsonPath('data.status', 'publish');

    $this->assertDatabaseHas('deforestory', [
        'title_id' => 'Judul API Indonesia',
        'status' => 'publish',
    ]);
});

it('creates and updates external deforestory data through the sync endpoint', function () {
    config(['services.deforestory.api_token' => 'test-token']);

    $payload = [
        'external_id' => 'partner-article-123',
        'title_id' => 'Judul Awal',
        'title_en' => 'Initial Title',
        'desrkirpsi_id' => 'Deskripsi awal',
        'desrkirpsi_en' => 'Initial description',
        'date' => '2026-07-31',
        'content_id' => 'Konten awal',
        'content_en' => 'Initial content',
        'status' => 'draft',
    ];

    $this->withToken('test-token')
        ->postJson('/api/deforestory/sync', $payload)
        ->assertCreated()
        ->assertJsonPath('action', 'created');

    $this->withToken('test-token')
        ->postJson('/api/deforestory/sync', [
            ...$payload,
            'title_id' => 'Judul Diperbarui',
            'status' => 'publish',
        ])
        ->assertOk()
        ->assertJsonPath('action', 'updated')
        ->assertJsonPath('data.title_id', 'Judul Diperbarui')
        ->assertJsonPath('data.status', 'publish');

    expect(DB::table('deforestory')->where('external_id', 'partner-article-123')->count())
        ->toBe(1);
});

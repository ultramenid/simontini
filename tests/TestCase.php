<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Middleware CMS memvalidasi sesi terhadap tabel users (aktif + role
        // admin), jadi pengguna admin harus ada untuk tes rute CMS.
        // insertOrIgnore agar admin lokal pengembang tidak pernah tertimpa;
        // update role berjalan di dalam transaksi tes dan di-rollback.
        DB::table('users')->insertOrIgnore([
            'id' => 1,
            'name' => 'Test Admin',
            'email' => 'test-admin@simontini.test',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role_id' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->where('id', 1)->update(['role_id' => 1, 'status' => 1]);
    }
}
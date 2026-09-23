<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kredensial seeder hanya boleh ada di lingkungan lokal agar
        // db:seed di staging/produksi tidak menimpa password admin.
        if (! app()->environment('local')) {
            return;
        }

        $this->call(UserRoleSeeder::class);
    }
}

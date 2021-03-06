<?php

namespace Database\Seeders;

use App\Models\TeamNotice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TeamSeeder::class,
            NoticeSeeder::class,
            TeamNoticeSeeder::class
        ]);
    }
}

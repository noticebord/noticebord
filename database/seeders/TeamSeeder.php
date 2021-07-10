<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('teams')->insert([
            'user_id'       => 1,
            'name'          => "User's Team",
            'personal_team' => true,
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}

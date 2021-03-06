<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Hash};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('users')->insert([
            'name'          => 'User',
            'email'         => 'user@mail.com',
            'password'      => Hash::make('password'),
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}

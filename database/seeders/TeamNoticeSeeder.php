<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamNoticeSeeder extends Seeder
{
    private const NUM = 100;
    private const BODY = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices = [];

        $body = str_repeat(self::BODY, 20);

        for($i = 1; $i <= self::NUM; $i++)
        {
            $created = now()->subMinutes($i + 5);
            $notices[] = 
            [
                'title'      => "Team Notice $i",
                'body'       => $body,
                'author_id'  => 1,
                'team_id'    => 1,
                'created_at' => $created,
                'updated_at' => $created->addMinutes(5),
                'deleted_at' => null
            ];
        }

        DB::table('team_notices')->insert($notices);
    }
}

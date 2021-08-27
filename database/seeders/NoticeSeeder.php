<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeSeeder extends Seeder
{
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

        for($i = 1; $i <= 20; $i++)
        {
            $created = now()->subMinutes($i + 5);
            $anonymous = random_int(0, 10) > 3;

            $notices[] = 
            [
                'title'      => "Notice $i",
                'body'       => $body,
                'public'  => $anonymous || random_int(0, 10) < 7,
                'author_id'  => $anonymous ? null : 1,
                'created_at' => $created,
                'updated_at' => $created->addMinutes(5),
                'deleted_at' => null
            ];
        }

        DB::table('notices')->insert($notices);
    }
}

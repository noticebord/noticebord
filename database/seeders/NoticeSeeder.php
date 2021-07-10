<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeSeeder extends Seeder
{
    private const TEXT = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ";
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices = [];

        $text = str_repeat(self::TEXT, 20);

        for($i = 1; $i <= 20; $i++)
        {
            $created = now()->subMinutes($i + 5);
            $notices[] = 
            [
                'title'      => "Notice $i",
                'text'       => $text,
                'author_id'  => 1,
                'created_at' => $created,
                'updated_at' => $created->addMinutes(5),
                'deleted_at' => null
            ];
        }

        DB::table('notices')->insert($notices);
    }
}

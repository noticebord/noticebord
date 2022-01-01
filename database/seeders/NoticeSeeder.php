<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;

class NoticeSeeder extends Seeder
{
    private const NUM = 100; 
    private const BODY = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ";
    private const TOPICS = ["tech", "lifestyle", "opinion", "jobs", "fun", "news", "sports", "entertainment", "general"];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices = [];

        $body = str_repeat(self::BODY, 20);

        for ($i = 1; $i <= self::NUM; $i++) {
            $created = now()->toImmutable()->subMinutes($i + 5);
            $anonymous = random_int(0, 10) > 3;

            $indices = array_rand(self::TOPICS, random_int(1, 5));
            $indices = is_array($indices) ? $indices : [$indices];
            $topics = array_map(fn ($i) => self::TOPICS[$i], $indices);

            Notice::create([
                'title'      => "Notice $i",
                'body'       => $body,
                'public'     => $anonymous || random_int(0, 10) < 7,
                'author_id'  => $anonymous ? null : 1,
                'created_at' => $created,
                'updated_at' => $created->addMinutes(5),
                'deleted_at' => null,
                'tags'       => $topics,
            ]);
        }
    }
}

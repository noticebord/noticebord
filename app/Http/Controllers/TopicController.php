<?php

namespace App\Http\Controllers;

use App\Models\{Notice, Topic};
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('taggables')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->join('notices', 'notices.id', '=', 'taggables.taggable_id')
            ->selectRaw('tags.id, name, count(tag_id) as count')
            ->where('public', true)
            ->groupBy('tags.id', 'name')
            ->orderBy('count', 'desc')
            ->get()
            ->map(fn ($t) => [
                'id'    => $t->id,
                'name'  => json_decode($t->name)->en,
                'count' => $t->count,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($topic)
    {
        $t = Topic::findOrFail($topic);
        $count = Notice::withAllTagsOfAnyType([$t->name])
            ->where('public', true)
            ->count();

        return [
            'id'    => $t->id,
            'name'  => $t->name,
            'count' => $count,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $topic
     * @return \Illuminate\Http\Response
     */
    public function notices($topic)
    {
        return Notice::withAllTagsOfAnyType([Topic::findOrFail($topic)->name])
            ->with(['author'])
            ->where('public', true)
            ->cursorPaginate(self::PER_PAGE);
    }
}

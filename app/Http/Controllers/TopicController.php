<?php

namespace App\Http\Controllers;

use App\Models\{Notice, Topic};

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Topic::with('notices')->get()->map(fn ($topic) => [
            'id'    => $topic->id,
            'name'  => $topic->name,
            'type'  => $topic->type,
            'count' => $topic->notices->count(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $topic
     * @return \Illuminate\Http\Response
     * @todo Fix count
     */
    public function show($topic)
    {
        $t = Topic::with('notices')->findOrFail($topic);
        return [
            'id'    => $t->id,
            'name'  => $t->name,
            'type'  => $t->type,
            'count' => $t->notices->count(),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $topic
     * @return \Illuminate\Http\Response
     * @todo Fix count
     */
    public function notices($topic)
    {
        return Notice::withAllTagsOfAnyType([Topic::findOrFail($topic)->name])
            ->with(['author'])
            ->get();
    }
}

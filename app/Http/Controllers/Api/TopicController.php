<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Notice, Topic};
use Illuminate\Http\{Request, Response};

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::with('notices')->findOrFail($id);
        return [
            'id'    => $topic->id,
            'name'  => $topic->name,
            'type'  => $topic->type,
            'count' => $topic->notices->count(),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notices($id)
    {
        $topic = Topic::findOrFail($id);
        $name = $topic->name;
        return Notice::withAllTagsOfAnyType([$name])->get();
    }
}

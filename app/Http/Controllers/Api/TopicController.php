<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\{ Request, Response };
use Illuminate\Support\Facades\Auth;
use Spatie\Tags\Tag;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tag::all()->map(fn ($tag) => [
            'id'   => $tag->id,
            'name' => $tag->name,
            'type' => $tag->type
        ]);
    }
}

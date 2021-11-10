<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        // TODO: Is this a good idea?
        return User::findOrFail($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $topic
     * @return \Illuminate\Http\Response
     */
    public function notices($user)
    {
        return User::with(['notices'])
            ->findOrFail($user)
            ->notices()
            ->where('public', true)
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $topic
     * @return \Illuminate\Http\Response
     */
    public function notes($user)
    {
        $user = User::with(['notices'])->findOrFail($user);
        abort_unless(Auth::guard('sanctum')->id() === $user->id, Response::HTTP_FORBIDDEN);
        return $user->notices()->where('public', false)->get();
    }
}
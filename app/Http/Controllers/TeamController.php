<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ItemNotFoundException;

// TODO: Limit number of teams that can be created by a single user
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();
        return $user->allTeams()->sortBy('id');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $team
     * @return \Illuminate\Http\Response
     */
    public function show($team)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();

        try {
            return $user->allTeams()->sole('id', $team);
        } catch (ItemNotFoundException) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Collections\ItemNotFoundException;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Auth;

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
        return $user->allTeams();
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

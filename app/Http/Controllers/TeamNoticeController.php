<?php

namespace App\Http\Controllers;

use App\Models\{Team, TeamNotice};
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Auth;

class TeamNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($team)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();
        $team = Team::find($team);

        $user->hasTeamPermission($team, 'read');

        $userCanRead = $user->hasTeamPermission($team, 'read');
        abort_unless($userCanRead, Response::HTTP_FORBIDDEN);

        return TeamNotice::with(['author'])
            ->where('team_id', $team->id)
            ->cursorPaginate(self::PER_PAGE);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $team)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();
        $team = Team::find($team);

        $userCanCreate = $user->hasTeamPermission($team, 'create');
        abort_unless($userCanCreate, Response::HTTP_FORBIDDEN);

        $data = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'body'      => ['required', 'string']
        ]);

        $notice = new TeamNotice($data);
        $notice->author_id = $user->id;
        $notice->team_id = $team->id;
        $notice->save();

        return response()->json($notice->load(['author'])->makeHidden(['body']), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $team
     * @param  int  $notice
     * @return \Illuminate\Http\Response
     */
    public function show($team, $notice)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();
        $team = Team::find($team);

        $userCanRead = $user->hasTeamPermission($team, 'read');
        abort_unless($userCanRead, Response::HTTP_FORBIDDEN);

        return TeamNotice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->where('team_id', $team->id)
            ->findOrFail($notice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $team
     * @param  int  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $team, $notice)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();
        $team = Team::find($team);

        $userCanUpdate = $user->hasTeamPermission($team, 'update');
        abort_unless($userCanUpdate, Response::HTTP_FORBIDDEN);

        $data = $request->validate([
            'title'     => ['nullable', 'string', 'max:255'],
            'body'      => ['nullable', 'string']
        ]);

        /** @var \App\Models\Notice $notice */
        $notice = TeamNotice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->where('team_id', $team->id)
            ->findOrFail($notice);

        $notice->update([
            'title'     => $data['title'] ?? $notice->title,
            'body'      => $data['body'] ?? $notice->body
        ]);

        return $notice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $team
     * @param  int  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($team, $notice)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('sanctum')->user();
        $team = Team::find($team);

        $userCanDelete = $user->hasTeamPermission($team, 'delete');
        abort_unless($userCanDelete, Response::HTTP_FORBIDDEN);

        /** @var \Illuminate\Database\Eloquent\Model $notice */
        $notice = TeamNotice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->where('team_id', $team->id)
            ->findOrFail($notice);

        $notice->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

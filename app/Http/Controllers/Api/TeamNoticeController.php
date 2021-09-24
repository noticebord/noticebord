<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Team;
use App\Models\TeamNotice;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Auth;

class TeamNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId)
    {
        return TeamNotice::with(['author'])
            ->where('team_id', $teamId)
            ->get()
            ->makeHidden(['body']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $team)
    {
        $data = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'body'      => ['required', 'string']
        ]);

        $notice = new TeamNotice($data);
        $notice->author_id = Auth::guard('sanctum')->id();
        $notice->team_id = $team;;
        $notice->save();

        return response()->json($notice->load(['author'])->makeHidden(['body']), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $team
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($team, $id)
    {
        return TeamNotice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->where('team_id', $team)
            ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $team
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $team, $id)
    {
        $data = $request->validate([
            'title'     => ['nullable', 'string', 'max:255'],
            'body'      => ['nullable', 'string']
        ]);

        /** @var \App\Models\Notice $notice */
        $notice = Notice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->where('team_id', $team)
            ->findOrFail($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($team, $id)
    {
        /** @var \Illuminate\Database\Eloquent\Model $notice */
        $notice = Notice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->where('team_id', $team)            
            ->findOrFail($id);

        $notice->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

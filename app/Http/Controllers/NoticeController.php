<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\{ Request, Response };
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Notice::with(['author'])
            ->where('public', true)
            ->cursorPaginate(self::PER_PAGE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'body'      => ['required', 'string'],
            'topics'    => ['present', 'array'],
            'topics.*'  => ['string']
        ]);

        $anonymous = $request->boolean('anonymous', false);
        $data['public'] = $anonymous || $request->boolean('public', false);

        $notice = new Notice($data);
        $notice->author_id = $anonymous ? null : Auth::guard('sanctum')->id();
        $notice->save();

        $notice->attachTags($data['topics']);

        return response()->json($notice->load(['author'])->makeHidden(['body']), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $notice
     * @return \Illuminate\Http\Response
     */
    public function show($notice)
    {
        $notice = Notice::with(['author'])->findOrFail($notice);
        $guard = Auth::guard('sanctum');

        $belongsToCurrent = $guard->check() && $notice->author_id === $guard->id();
        abort_unless($notice->public || $belongsToCurrent, Response::HTTP_NOT_FOUND); 
    
        return $notice->makeVisible(['body']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $notice)
    {
        // TODO: Validate
        $data = $request->validate([
            'title'     => ['nullable', 'string', 'max:255'],
            'body'      => ['nullable', 'string'],
            'topics'    => ['nullable', 'array'],
            'topics.*'  => ['string']
        ]);

        $anonymous = $request->boolean('anonymous', false);

        /** @var \App\Models\Notice $notice */
        $notice = Notice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->findOrFail($notice);

        $notice->update([
            'title'     => $data['title'] ?? $notice->title,
            'body'      => $data['body'] ?? $notice->body,
            'public'    => $anonymous || $request->boolean('public', false),
        ]);

        if ($anonymous) {
            $notice->author()->dissociate();
        }

        if ($data['topics'] !== null) {
            $notice->syncTags($data['topics']);
        }

        $notice->save(); // TODO: Error handling
        return $notice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($notice)
    {
        /** @var \Illuminate\Database\Eloquent\Model $notice */
        $notice = Notice::with(['author'])
            ->where('author_id', Auth::guard('sanctum')->id())
            ->findOrFail($notice);
            
        $notice->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

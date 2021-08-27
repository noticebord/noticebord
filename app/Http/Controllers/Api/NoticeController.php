<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            ->get()
            ->makeHidden(['body']);
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
            'body'      => ['required', 'string']
        ]);

        $anonymous = $request->boolean('anonymous', false);
        $data['public'] = $anonymous || $request->boolean('is_public', false);

        $notice = new Notice($data);
        $notice->author_id = $anonymous ? null : Auth::guard('sanctum')->id();
        $notice->save();

        return $notice->load(['author'])->makeHidden(['body']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::with(['author'])->findOrFail($id);
        $guard = Auth::guard('sanctum');

        $belongsToCurrent = $guard->check() && $notice->author_id === $guard->id();
        abort_unless($notice->public || $belongsToCurrent, Response::HTTP_NOT_FOUND); 
    
        return $notice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

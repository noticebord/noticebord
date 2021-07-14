<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        return Notice::with(['author'])->get();
    }

    public function show($noticeId)
    {
        return Notice::with(['author'])->find($noticeId);
    }
}

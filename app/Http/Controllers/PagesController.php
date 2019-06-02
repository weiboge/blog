<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;

class PagesController extends Controller
{
    public function root()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('pages.root', compact('feed_items'));
    }
    public function about()
    {
        return view('pages/about');
    }
    public function weibo()
    {
        return view('pages/weibo');
    }
    public function bbs()
    {
        return view('pages/bbs');
    }
}

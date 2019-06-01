<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
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

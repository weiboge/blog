<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
use App\Models\User;

class PagesController extends Controller
{
//由于我们在用户模型中已定义好了 feed 方法，因此我们可以在主页对应的控制器动作 home 中使用该方法来获取用户的微博动态。
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
    public function weibo(User $user,Status $status)
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('pages/weibo', compact('feed_items'));
    }
    public function bbs()
    {
        return view('pages/bbs');
    }
}

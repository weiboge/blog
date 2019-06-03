<?php

//用户关注控制器

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
//    判定是否登陆，只有登陆用户
    public function __construct()
    {
        $this->middleware('auth');
    }
//    关注
    public function store(User $user)
    {
        $this->authorize('follow', $user);

        if ( ! Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }
//    取消关注
    public function destroy(User $user)
    {
//        关注功能授权
        $this->authorize('follow', $user);

        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }
}

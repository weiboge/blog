<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
//        方法接收两个参数，第一个参数默认为当前登录用户实例，
//第二个参数则为要进行授权的用户实例。当两个 id 相同时，则代表两个用户是相同用户，用户通过授权
        return $currentUser->id === $user->id;
    }
    public function destroy(User $currentUser, User $user)
    {
//        只有当前用户拥有管理员权限且删除的用户不是自己时才显示链接
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

    //关注授权
    public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }
}

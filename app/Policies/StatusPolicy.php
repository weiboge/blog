<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Status $status)
    {
//        当前用户的 id 与要删除的微博作者 id 相同时
        return $user->id === $status->user_id;
    }
}

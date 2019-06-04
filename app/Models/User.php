<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//Eloquent 模型默认提供了多个事件，
//我们可以通过其提供的事件来监听到模型的创建，更新，删除，保存等操作。
//creating 用于监听模型被创建之前的事件，created 用于监听模型被创建之后的事件
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//为 gravatar 方法传递的参数 size 指定了默认值 100；
//通过 $this->attributes['email'] 获取到用户的邮箱；
//使用 trim 方法剔除邮箱的前后空白内容；
//用 strtolower 方法将邮箱转换为小写；
//将小写的邮箱使用 md5 方法进行转码；
//将转码后的邮箱与链接、尺寸拼接成完整的 URL 并返回；
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }
//    一对多，用户有很多微博
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

//    动态流
    public function feed()
    {
        return $this->statuses()
            ->orderBy('created_at', 'desc');
    }
//    public function feed()
//    {
//        $user_ids = $this->followings->pluck('id')->toArray();
//        array_push($user_ids, $this->id);
//        return Status::whereIn('user_id', $user_ids)
//            ->with('user')
//            ->orderBy('created_at', 'desc');
//    }
//    关注逻辑
    public function follow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }
//    取消关注逻辑
    public function unfollow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }
//    判断是否已经关注
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
//    用户有很多关注人
    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }
//    用户有很多粉丝
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

//    用户有很多话题

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

}

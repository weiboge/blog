<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
//      微博模型中可以进行正常更新的字段
    protected $fillable = ['content'];
//一对多，微博属于用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

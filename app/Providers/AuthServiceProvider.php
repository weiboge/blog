<?php

//策略授权

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
//  该属性用于将各种模型对应到管理它们的授权策略上。我们需要为用户模型 User 指定授权策略 UserPolicy
    protected $policies = [
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\Models\User::class  => \App\Policies\UserPolicy::class,
        \App\Models\Status::class  => \App\Policies\StatusPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

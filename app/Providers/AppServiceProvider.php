<?php

//AppServiceProvider 是框架的核心，在 Laravel 启动时，会最先加载该文件

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);

//        Carbon 是 PHP DateTime 的一个简单扩展，Laravel 将其默认集成到了框架中。对 Carbon 进行本地化的设置很简单，只在 AppServiceProvider 中调用 Carbon 的 setLocale 方法即可
        Carbon::setLocale('zh');
    }
}

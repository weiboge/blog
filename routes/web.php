<?php

//静态页面
Route::get('/', 'PagesController@root')->name('root');
Route::get('/weibo', 'PagesController@weibo')->name('weibo');
Route::get('/bbs', 'PagesController@root')->name('bbs');

Route::get('/about', 'PagesController@about')->name('about');

//注册
Route::get('signup', 'UsersController@create')->name('signup');

//登陆
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//用户
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');

//个人详情
Route::get('/users/{user}/information', 'UsersController@information')->name('users.information');

Route::get('/users/{user}', 'UsersController@show')->name('users.show');

Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

//验证邮件路由，为用户的激活功能设定好路由，该路由将附带用户生成的激活令牌
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//密码重置
//显示重置密码的邮箱发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//邮箱发送重设链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//密码更新页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//执行密码更新操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//微博创建与删除
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//用户关注者和粉丝列表
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

//关注用户和取消用户
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');


//// 用户身份验证相关的路由
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
//// 用户注册相关路由
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
//
//// 密码重置相关路由
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//
//// Email 认证相关路由
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
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
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

//验证邮件路由
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//密码重置
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

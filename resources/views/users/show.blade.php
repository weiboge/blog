//用户个人页面

@extends('layouts.app')
@section('title', $user->name)

@section('content')
  <div class="row">
    <div class="offset-md-2 col-md-8">

      <section class="user_info">
{{--        我们可以通过给 @include 方法传参，将用户数据以关联数组的形式传送到 _user_info 局部视图上--}}
        @include('shared._user_info', ['user' => $user])
      </section>
      <section class="stats mt-2">
        @include('shared._stats', ['user' => $user])
      </section>
      @if (Auth::check())
        @include('users._follow_form')
      @endif
      <hr>
      <section class="status">
        @if ($statuses->count() > 0)
          <ul class="list-unstyled">
            @foreach ($statuses as $status)
              @include('statuses._status')
            @endforeach
          </ul>
          <div class="mt-5">
            {!! $statuses->render() !!}
          </div>
        @else
          <p>没有数据！</p>
        @endif
      </section>

    </div>
  </div>
@stop

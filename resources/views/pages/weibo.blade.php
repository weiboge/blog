@extends('layouts.app')

@section('content')
  @if (Auth::check())
    <div class="row">
      <div class="col-md-8">
        <section class="status_form">
          @include('shared._status_form')
        </section>
        <h4>微博列表</h4>
        <hr>
        @include('shared._feed')
      </div>
      <aside class="col-md-4">
        <section class="user_info">
          @include('shared._user_info', ['user' => Auth::user()])
        </section>
        <section class="stats mt-2">
          @include('shared._stats', ['user' => Auth::user()])
        </section>
      </aside>
    </div>
  @else
    <div class="jumbotron">
      <h1>Hello Laravel</h1>
      <p class="lead">
        你现在所看到的是 <a href="https://learnku.com/courses/laravel-essential-training">Laravel 入门教程</a> 的示例项目主页。
      </p>
      <p>
        一切，将从这里开始。
      </p>
      <p>
        <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
      </p>
    </div>
  @endif
@stop


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--  @if (Auth::check())--}}
{{--    <div class="row">--}}
{{--      <div class="col-md-8">--}}
{{--        <section class="status_form">--}}
{{--          @include('shared._status_form')--}}
{{--        </section>--}}
{{--        <h4>微博列表</h4>--}}
{{--        <hr>--}}

{{--        <ul class="list-unstyled">--}}
{{--          @foreach ($feed_items as $status)--}}
{{--            <li class="media mt-4 mb-4">--}}
{{--              <a href="#">--}}
{{--                <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar"/>--}}
{{--              </a>--}}
{{--              <div class="media-body">--}}
{{--                <h5 class="mt-0 mb-1">{{ $user->name }} <small> / {{ $status->created_at->diffForHumans() }}</small></h5>--}}
{{--                {{ $status->content }}--}}
{{--              </div>--}}
{{--            </li>--}}
{{--          @endforeach--}}
{{--        </ul>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--@stop--}}
{{--      <aside class="col-md-4">--}}
{{--        <section class="user_info">--}}
{{--          @include('shared._user_info', ['user' => Auth::user()])--}}
{{--        </section>--}}
{{--        <section class="stats mt-2">--}}
{{--          @include('shared._stats', ['user' => Auth::user()])--}}
{{--        </section>--}}
{{--      </aside>--}}
{{--    </div>--}}
{{--  @else--}}
{{--    <div class="jumbotron">--}}
{{--      <h1>Hello Laravel</h1>--}}
{{--      <p class="lead">--}}
{{--        你现在所看到的是 <a href="https://learnku.com/courses/laravel-essential-training">Laravel 入门教程</a> 的示例项目主页。--}}
{{--      </p>--}}
{{--      <p>--}}
{{--        一切，将从这里开始。--}}
{{--      </p>--}}
{{--      <p>--}}
{{--        <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>--}}
{{--      </p>--}}
{{--    </div>--}}
{{--  @endif--}}
{{--@stop--}}

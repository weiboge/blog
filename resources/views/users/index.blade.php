{{--所有用户视图--}}

@extends('layouts.app')
@section('title', '所有用户')

@section('content')
  <div class="offset-md-2 col-md-8">
    <h2 class="mb-4 text-center">所有用户</h2>
    <div class="list-group list-group-flush">
      @foreach ($users as $user)
        @include('users._user')
      @endforeach
    </div>

    <div class="mt-3">
      {!! $users->render() !!}
{{--      在调用 paginate 方法获取用户列表之后，便可以通过以下代码在用户列表页上渲染分页链接。--}}
{{--      由 render 方法生成的 HTML 代码默认会使用 Bootstrap 框架的样式，渲染出来的视图链接也都统一会带上 ?page 参数来设置指定页数的链接--}}
    </div>
  </div>
@stop

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Weibo') - Laravel</title>

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div id="app" class="{{ route_class() }}-page">



  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
      <!-- Branding Image -->
      <a class="navbar-brand " href="{{ route('root') }}">
        WeiBo
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"><a class="nav-link" href="{{ route('topics.index') }}">话题</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('categories.show', 1) }}">分享</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('categories.show', 2) }}">教程</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('categories.show', 3) }}">问答</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('categories.show', 4) }}">公告</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav navbar-right">
          @if (Auth::check())
            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">个人中心</a>
                <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">编辑资料</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" id="logout" href="#">
                  <form action="{{ route('logout') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                  </form>
                </a>
              </div>
            </li>
          @else
          <!-- Authentication Links -->
            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">登录</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('signup') }}">注册</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">

    @include('shared._messages')

    @yield('content')

  </div>

  @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>

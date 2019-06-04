

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
        <li class="nav-item"><a class="nav-link" href="{{route('weibo')}}">博客</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('topics.index')}}">Laravel 社区</a></li>
        <li class="nav-item"><a class="nav-link" href="#">教程</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('about')}}">关于</a></li>

      </ul>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link" href="{{ route('topics.index') }}">话题</a></li>
        <li class="nav-item {{ category_nav_active(1) }}"><a class="nav-link" href="{{ route('categories.show', 1) }}">分享</a></li>
        <li class="nav-item {{ category_nav_active(2) }}"><a class="nav-link" href="{{ route('categories.show', 2) }}">教程</a></li>
        <li class="nav-item {{ category_nav_active(3) }}"><a class="nav-link" href="{{ route('categories.show', 3) }}">问答</a></li>
        <li class="nav-item {{ category_nav_active(4) }}"><a class="nav-link" href="{{ route('categories.show', 4) }}">公告</a></li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav navbar-right">
        @if (Auth::check())
          <li class="nav-item"><a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}"><i class="fa fa-plus"></i></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}"><i class="far fa-user mr-2"></i>个人中心</a>
              <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}"><i class="far fa-edit mr-2"></i>编辑资料</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" id="logout" href="#">
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="btn btn-block btn-danger" type="submit" name="button" >退出</button>
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

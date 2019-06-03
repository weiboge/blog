{{--用户的头像和用户名等基本信息--}}

<a href="{{ route('users.show', $user->id) }}">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/>
</a>
<h1><a href="{{route('users.information', $user->id)}}"> {{ $user->name }}</a></h1>

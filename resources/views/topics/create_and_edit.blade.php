{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--<div class="container">--}}
{{--  <div class="col-md-10 offset-md-1">--}}
{{--    <div class="card ">--}}

{{--      <div class="card-header">--}}
{{--        <h1>--}}
{{--          Topic /--}}
{{--          @if($topic->id)--}}
{{--            Edit #{{ $topic->id }}--}}
{{--          @else--}}
{{--            Create--}}
{{--          @endif--}}
{{--        </h1>--}}
{{--      </div>--}}

{{--      <div class="card-body">--}}
{{--        @if($topic->id)--}}
{{--          <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">--}}
{{--          <input type="hidden" name="_method" value="PUT">--}}
{{--        @else--}}
{{--          <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">--}}
{{--        @endif--}}

{{--          @include('common.error')--}}

{{--          <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

{{--          --}}
{{--                <div class="form-group">--}}
{{--                	<label for="title-field">Title</label>--}}
{{--                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                	<label for="body-field">Body</label>--}}
{{--                	<textarea name="body" id="body-field" class="form-control" rows="3">{{ old('body', $topic->body ) }}</textarea>--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                    <label for="user_id-field">User_id</label>--}}
{{--                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $topic->user_id ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                    <label for="category_id-field">Category_id</label>--}}
{{--                    <input class="form-control" type="text" name="category_id" id="category_id-field" value="{{ old('category_id', $topic->category_id ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                    <label for="reply_count-field">Reply_count</label>--}}
{{--                    <input class="form-control" type="text" name="reply_count" id="reply_count-field" value="{{ old('reply_count', $topic->reply_count ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                    <label for="view_count-field">View_count</label>--}}
{{--                    <input class="form-control" type="text" name="view_count" id="view_count-field" value="{{ old('view_count', $topic->view_count ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                    <label for="last_reply_user_id-field">Last_reply_user_id</label>--}}
{{--                    <input class="form-control" type="text" name="last_reply_user_id" id="last_reply_user_id-field" value="{{ old('last_reply_user_id', $topic->last_reply_user_id ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                    <label for="order-field">Order</label>--}}
{{--                    <input class="form-control" type="text" name="order" id="order-field" value="{{ old('order', $topic->order ) }}" />--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                	<label for="excerpt-field">Excerpt</label>--}}
{{--                	<textarea name="excerpt" id="excerpt-field" class="form-control" rows="3">{{ old('excerpt', $topic->excerpt ) }}</textarea>--}}
{{--                </div> --}}
{{--                <div class="form-group">--}}
{{--                	<label for="slug-field">Slug</label>--}}
{{--                	<input class="form-control" type="text" name="slug" id="slug-field" value="{{ old('slug', $topic->slug ) }}" />--}}
{{--                </div>--}}

{{--          <div class="well well-sm">--}}
{{--            <button type="submit" class="btn btn-primary">Save</button>--}}
{{--            <a class="btn btn-link float-xs-right" href="{{ route('topics.index') }}"> <- Back</a>--}}
{{--          </div>--}}
{{--        </form>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}

{{--@endsection--}}

@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">

        <div class="card-body">
          <h2 class="">
            <i class="far fa-edit"></i>
            @if($topic->id)
              编辑话题
            @else
              新建话题
            @endif
          </h2>

          <hr>

          @if($topic->id)
            <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
              @else
                <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                  @endif

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  @include('shared._errors')

                  <div class="form-group">
                    <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required />
                  </div>

                  <div class="form-group">
                    <select class="form-control" name="category_id" required>
                      <option value="" hidden disabled selected>请选择分类</option>
                      @foreach ($categories as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <textarea name="body" class="form-control" id="editor" rows="6" placeholder="请填入至少三个字符的内容。" required>{{ old('body', $topic->body ) }}</textarea>
                  </div>

                  <div class="well well-sm">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
                  </div>
                </form>
        </div>
      </div>
    </div>
  </div>

@endsection

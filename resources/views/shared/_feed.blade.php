{{--微博动态流局部视图--}}

@if ($feed_items->count() > 0)
  <ul class="list-unstyled">
    @foreach ($feed_items as $status)
      @include('statuses._status',  ['user' => $status->user])
    @endforeach
  </ul>
  <div class="mt-5">
    {!! $feed_items->render() !!}
  </div>
@else
  <p>没有数据！</p>
@endif



{{--@if ($feed_items->count() > 0)--}}
{{--  <ul class="list-unstyled">--}}
{{--    @foreach ($feed_items as $status)--}}
{{--      @include('statuses._status')--}}
{{--    @endforeach--}}
{{--  </ul>--}}
{{--  <div class="mt-5">--}}
{{--    {!! $feed_items->render() !!}--}}
{{--  </div>--}}
{{--@else--}}
{{--  <p>没有数据！</p>--}}
{{--@endif--}}

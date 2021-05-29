@if (count($works) > 0)
    <div class="row">
        @foreach ($works as $work)
            <div class="col-3 offset-1 bg-white">
               <div style="height: 200px; border: solid;"></div>
                <div class="media-body">
                    <!--<div>-->
                    <!--    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}-->
                    <!--    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!}-->
                    <!--    <span class="text-muted">posted at {{ $work->created_at }}</span>-->
                    <!--</div>-->
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="my-2 mb-0 text-center">{!! nl2br(e($work->title)) !!}</p>
                    </div>
                    <!--<div>-->
                    <!--    @if (Auth::id() == $work->user_id)-->
                    <!--        {{-- 投稿削除ボタンのフォーム --}}-->
                    <!--        {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}-->
                    <!--            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}-->
                    <!--        {!! Form::close() !!}-->
                    <!--    @endif-->
                    <!--</div>-->
                </div>
            </div>
        @endforeach
    </div>
    {{-- ページネーションのリンク --}}
    {{ $works->links() }}
@endif
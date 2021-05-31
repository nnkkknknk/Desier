@if (count($works) > 0)
        
        <div class="row">
            @foreach ($works as $work)
           
                <div class="col-3 offset-1 bg-white my-3">
                   <div style="height: 200px; border: solid;">
                       
                   </div>
                    <div class="media-body">
                        <!--<div>-->
                        <!--    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}-->
                        <!--    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!}-->
                        <!--    <span class="text-muted">posted at {{ $work->created_at }}</span>-->
                        <!--</div>-->
                        <div>
                            {{-- 投稿内容 --}}
                            <!--<p class="my-2 mb-0 text-center">{!! nl2br(e($work->title)) !!}</p>-->
                            <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($work->title)), ['work' => $work->id]) !!}</p>
                        </div>
                        <div>
                            @if (Auth::id() == $work->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!--<div class="row add-control">-->
        <!--     <input type="radio" class="radio" id="open" name="btn" /><label class="btn btn-open rounded-pill bg-dark text-white" for="open">すべてをみる</label>-->
        <!--      <input type="radio" class="radio" id="close" name="btn" checked="checked" /> -->
        <!--      <label class="btn btn-close rounded-pill bg-dark text-white" for="close">閉じる</label>-->
        <!--      <div class="box">制御されるコンテンツ</div>-->
                    
            
        <!--    foreach (4 as $work)-->
        <!--        <div class="col-3 offset-1 bg-white">-->
        <!--           <div style="height: 200px; border: solid;"></div>-->
        <!--            <div class="media-body">-->
                        <!--<div>-->
                        <!--    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}-->
                        <!--    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!}-->
                        <!--    <span class="text-muted">posted at {{ $work->created_at }}</span>-->
                        <!--</div>-->
        <!--                <div>-->
        <!--                    {{-- 投稿内容 --}}-->
        <!--                    <p class="my-2 mb-0 text-center">{!! nl2br(e($work->title)) !!}</p>-->
        <!--                </div>-->
        <!--                <div>-->
        <!--                    @if (Auth::id() == $work->user_id)-->
        <!--                        {{-- 投稿削除ボタンのフォーム --}}-->
        <!--                        {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}-->
        <!--                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}-->
        <!--                        {!! Form::close() !!}-->
        <!--                    @endif-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    endforeach-->
        <!--</div>-->
    {{-- ページネーションのリンク --}}
    {{ $works->links() }}
@endif
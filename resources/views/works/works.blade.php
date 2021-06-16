@if (count($works) > 0)
     @php
     $num = count($works);
    @endphp
    @if(count($works) <= $top_num)
        <div class="row">
            
            @for ($i = 0; $i < $num; $i++) 
                 @php
                   $work = $works->get($i);
                 @endphp
               <!--foreach($works as $work)-->
               <!--     if($loop->index < 3)-->
                        <div class="col-3 offset-1 bg-white my-3">
                           <div style="height: 200px; border: solid;">
                               
                           </div>
                            <div class="media-body">
                                
                                 <!--OK-->
                                @php
                                    //dd($work->user->id);
                                @endphp
                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {{!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!}}
                                    <!--<span class="text-muted">posted at {{ $work->created_at }}</span>　-->
                                </div>
                                
                                <div>
                                    {{-- 投稿内容 --}}
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
                        <!--endif-->
            @endfor
        </div>  
        
    @endif
    
    @if(count($works) > $top_num)
        <!--<div class='bg-primary'>-->
        <!--    <?php-->
                
        <!--        echo $top_num;-->
        <!--        echo $num;-->
        <!--    ?>-->
        <!--</div>-->
        
        <div class="row">
            
            @for ($i = 0; $i < $top_num; $i++) 
                 @php
                   $work = $works->get($i);
                 @endphp
               <!--foreach($works as $work)-->
               <!--     if($loop->index < 3)-->
                        <div class="col-3 offset-1 bg-white my-3">
                           <div style="height: 200px; border: solid;">
                               
                           </div>
                            <div class="media-body">
                                
                                 <!--OK-->
                                @php
                                    //dd($work->user->id);
                                @endphp
                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!} 
                                    <!--<span class="text-muted">posted at {{ $work->created_at }}</span>　-->
                                </div>
                                
                                <div>
                                    {{-- 投稿内容 --}}
                                    
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
                        <!--endif-->
            @endfor
        </div>  
        
        <!--<div class="add-control">-->
        <!--    <input type="radio" class="radio" id="open" name="btn" />-->
        <!--    <label class="btn btn-open rounded-pill bg-dark text-white" for="open">すべてをみる</label>-->
        <!--    <input type="radio" class="radio" id="close" name="btn" checked="checked"/> -->
        <!--    <label class="btn btn-close rounded-pill bg-dark text-white" for="close">閉じる</label>-->
        <!--    <div class="row box">制御されるコンテンツ-->
            
        <!--<div class="ac-box  row">-->
        <!--    <input id="ac-1" name="accordion-1" type="checkbox" />-->
        <!--    <label for="ac-1"> HTMLコード </label>-->
        <!--        <div class="ac-small">-->
        <!--            <p>ここにテキスト流す</p>-->
        <!--        </div>-->
        <div class="text-center my-3">
            <button class="btn rounded-pill bg-dark text-white" type="button" data-toggle="collapse" data-target="#mypost" aria-expanded="false" aria-controls="collapseExample">
                すべてみる
            </button>
        </div>
        <div class="collapse" id="mypost">
          <div class="card-body row">
             @for ($i = $top_num; $i < $num; $i++) 
                     @php
                       $work = $works->get($i);
                     @endphp
                     
                        <div class="col-3 offset-1 bg-white">
                           <div style="height: 200px; border: solid;">
                               
                           </div>
                            <div class="media-body">
                                
                                 <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!} 
                                    <!--<span class="text-muted">posted at {{ $work->created_at }}</span>　-->
                                </div>
                                
                                <div>
                                    {{-- 投稿内容 --}}
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
                 @endfor  
          </div>
        </div>
                   
        <!--</div>-->
            
        
            
            <!--</div>-->
                 
            
                 <!--endif-->
        <!--</div>-->
                        
                <!--endforeach-->
             <!--endfor-->
            
    @endif
@endif
    
@if (count($favoritings) > 0)
    
     @if(count($favoritings) <= 3)
        
        <div class="row">
            @for ($i = 0; $i < $top_num; $i++) 
                 @php
                   $favoriting = $favoritings->get($i);
                  
                 @endphp
               
                        <div class="col-3 offset-1 bg-white my-3">
                           <div style="height: 200px; border: solid;">
                              
                           </div>
                            <div class="media-body">
                                <div>
                                    
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show',$favoriting->user->name,  ['user' => $favoriting->user->id]) !!}
                                </div>
                                 
                                 
                                <div>
                              
                                    <!--{{-- 投稿内容 --}}-->
                                    <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($favoriting->title)), ['work' => $favoriting->id]) !!}</p>
                                </div>
                                 
                                <div>
                                    @if (Auth::id() != $favoriting->user_id)
                                        {{-- 投稿削除ボタンのフォーム --}}
                                        {!! Form::open(['route' => ['favorites.unfavorite', $favoriting->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        
            @endfor
        </div>  
    
    @endif
    
    @if(count($works) > 3)
        <div class="row">
            @for ($i = 0; $i < $top_num; $i++) 
                 @php
                   $favoriting = $favoritings->get($i);
                   dd($favoriting->user->name);
                 @endphp
               
                        <div class="col-3 offset-1 bg-white my-3">
                           <div style="height: 200px; border: solid;">
                               
                           </div>
                            <div class="media-body">
                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {{!! link_to_route('users.show', $favoriting->user->name, ['user' => $favoriting->user->id]) !!}
                                </div>
                                <div>
                              
                                    <!--{{-- 投稿内容 --}}-->
                                    <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($favoriting->title)), ['work' => $favoriting->id]) !!}</p>
                                </div>
                                <div>
                                    @if (Auth::id() != $favoriting->user_id)
                                        {{-- 投稿削除ボタンのフォーム --}}
                                        {!! Form::open(['route' => ['favorites.unfavorite', $favoriting->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--endif-->
            @endfor
        </div>  
        
       
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
            
        
            
            </div>
                 
            
                 <!--endif-->
        </div>
                        
                <!--endforeach-->
             <!--endfor-->
            
        
    @endif
@endif
    
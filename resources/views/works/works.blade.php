@if (count($works) > 0)
   
    @if(count($works) <= $top_num)
        <div class="row">
            
            @for ($i = 0; $i < $num; $i++) 
                 @php
                   $work = $works->get($i);
                   $creater = $work->user;
                   $creater_icon = $creater->icon_file_path;
                   $thumbnail = $work->upload_images()->orderBy('id', 'asc')->first();
                   $thumbnail_path = $thumbnail ? $thumbnail->file_path : '';
                 @endphp
                 
                 
                        <div class="col-5 col-lg-3 offset-1 bg-white my-3">
                           <div class="my-3" style="height: 300px;">
                                 <img src="{{ Storage::url($thumbnail_path) }}" style="width:100%; height:100%;"/>
                           </div>
                            <div class="media-body">
                                
                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    
                                    @if ($creater_icon == null) 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <i class="fas fa-user-circle fa-2x align-middle"></i>
                                        </a>
                                    @else 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                        </a>
                                    @endif
                                    
                                    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!}
                                    <!--<span class="text-muted">posted at {{ $work->created_at }}</span>　-->
                                </div>
                                
                                <div>
                                    {{-- 投稿内容 --}}
                                    <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($work->title)), ['work' => $work->id]) !!}</p>
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
                        <!--endif-->
            @endfor
        </div>  
        
    @endif
    
    @if(count($works) > $top_num)
        
        <div class="row">
            
            @for ($i = 0; $i < $top_num; $i++) 
            
                 @php
                   $work = $works->get($i);
                   $creater = $work->user;
                   $creater_icon = $creater->icon_file_path;
                   $thumbnail = $work->upload_images()->orderBy('id', 'asc')->first();
                   $thumbnail_path = $thumbnail ? $thumbnail->file_path : ''
                   //$変数 = if($thumbnail) $thumbnail->file_path else ''（三項演算子）
                 @endphp
                 
                        <div class="col-5 col-lg-3 offset-1 bg-white my-3">
                            <div class="my-3" style="height: 300px;">
                                 <img src="{{ Storage::url($thumbnail_path) }}" style="width:100%; height:100%;"/>
                           </div>
                            <div class="media-body">
                                
                                <div>
                                    
                                    @if ($creater_icon == null) 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <i class="fas fa-user-circle fa-2x align-middle"></i>
                                        </a>
                                    @else 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                        </a>
                                    @endif
                                    
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!} 
                                    <!--<span class="text-muted">posted at {{ $work->created_at }}</span>　-->
                                </div>
                                
                                <div>
                                    <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($work->title)), ['work' => $work->id]) !!}</p>
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
                       $creater = $work->user;
                       $creater_icon = $creater->icon_file_path;
                       $thumbnail = $work->upload_images()->orderBy('id', 'asc')->first();
                       $thumbnail_path = $thumbnail ? $thumbnail->file_path : ''
                     @endphp
                        <div class="col-5 col-lg-3 offset-1 bg-white">
                           <div class="my-3" style="height: 300px;">
                                 <img src="{{ Storage::url($thumbnail_path) }}" style="width:100%; height:100%;"/>
                           </div>
                            <div class="media-body">
                                
                                 <div>
                                     
                                     @if ($creater_icon == null) 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <i class="fas fa-user-circle fa-2x align-middle"></i>
                                        </a>
                                    @else 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                        </a>
                                    @endif
                                     
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!} 
                                    <!--<span class="text-muted">posted at {{ $work->created_at }}</span>　-->
                                </div>
                                
                                <div>
                                    {{-- 投稿内容 --}}
                                    <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($work->title)), ['work' => $work->id]) !!}</p>
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
    
@else
    <div class="row bg-white my-3 center-block" style="height: 200px;">
      <h3 class="text-secondary offset-4 d-flex align-items-center">作品を追加しよう</h3>  
    </div>
@endif
    
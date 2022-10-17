@if (Auth::check())
    @if (Auth::id() == $user->id)
        
        <div class="row justify-content-center">
            <h3 class="col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center" style="background-color: #FFFF99; ">お気に入り</h3>
        </div>
        @if (count($favoritings) > 0)
            @php
             $num_fav = count($favoritings);
            @endphp
             @if(count($favoritings) <= $top_num)
                
                <div class="row">
                    @for ($i = 0; $i < $num_fav; $i++) 
                         @php
                           $favoriting = $favoritings->get($i);
                           $creater = $favoriting->user;
                           $creater_icon = $creater->icon_file_path;
                           $thumbnail = $favoriting->upload_images()->orderBy('id', 'asc')->first();
                           $thumbnail_path = $thumbnail ? $thumbnail->file_path : '';
                         @endphp
                       
                                <div class="col-12 col-sm-6 col-lg-4 my-5">
                                    <div class="bg-white px-3 py-4">
                                       <div class="my-3">
                                         <img src="{{ Storage::url($thumbnail_path) }}" style="width:100%; height:100%;"/>
                                       </div>
                                        <div class="media-body">
                                            <div>
                                                @if ($creater_icon == null) 
                                                    <a href="{{ route('users.show', ['user' => $favoriting->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                                        <i class="fas fa-user-circle fa-2x align-middle"></i>
                                                        {{$favoriting->user->name}}
                                                    </a>
                                                @else 
                                                    <a href="{{ route('users.show', ['user' => $favoriting->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                                        <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                                        {{$favoriting->user->name}}
                                                    </a>
                                                @endif
                                                <!--{{-- 投稿の所有者のユーザ詳細ページへのリンク --}}-->
                                                <!--{!! link_to_route('users.show',$favoriting->user->name,  ['user' => $favoriting->user->id]) !!}-->
                                            </div>
                                             
                                             
                                            <div>
                                          
                                                <!--{{-- 投稿内容 --}}-->
                                                <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($favoriting->title)), ['work' => $favoriting->id]) !!}</p>
                                            </div>
                                             
                                            
                                        </div>
                                    </div>
                                </div>
                                
                    @endfor
                </div>  
            
            @endif
            
            @if(count($works) > $top_num)
                <div class="row">
                    @for ($i = 0; $i < $top_num; $i++) 
                         @php
                           $favoriting = $favoritings->get($i);
                           $creater = $favoriting->user;
                           $creater_icon = $creater->icon_file_path;
                           $thumbnail = $favoriting->upload_images()->orderBy('id', 'asc')->first();
                           $thumbnail_path = $thumbnail ? $thumbnail->file_path : '';
                         @endphp
                                <div class="col-12 col-sm-6 col-lg-4 my-5">
                                    <div class="bg-white px-3 py-4">
                                        <div class="my-3">
                                            <img src="{{ Storage::url($thumbnail_path) }}" style="width:100%; height:100%;"/>
                                        </div>
                                        <div class= "media-body">
                                            <div>
                                                @if ($creater_icon == null) 
                                                    <a href="{{ route('users.show', ['user' => $favoriting->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                                        <i class="fas fa-user-circle fa-2x align-middle"></i>
                                                        {{$favoriting->user->name}}
                                                    </a>
                                                @else 
                                                    <a href="{{ route('users.show', ['user' => $favoriting->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                                        <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                                        {{$favoriting->user->name}}
                                                    </a>
                                                @endif
                                            <div>
                                          
                                                <!--{{-- 投稿内容 --}}-->
                                                <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($favoriting->title)), ['work' => $favoriting->id]) !!}</p>
                                            </div>
                                            <!--<div>-->
                                            <!--    @if (Auth::id() != $favoriting->user_id)-->
                                            <!--        {{-- 投稿削除ボタンのフォーム --}}-->
                                            <!--        {!! Form::open(['route' => ['favorites.unfavorite', $favoriting->id], 'method' => 'delete']) !!}-->
                                            <!--            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}-->
                                            <!--        {!! Form::close() !!}-->
                                            <!--    @endif-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                                <!--endif-->
                    @endfor
                </div>  
                
               
                <div class="text-center my-3">
                    <button class="btn rounded-pill bg-dark text-white" type="button" data-toggle="collapse" data-target="#favorite" aria-expanded="false" aria-controls="collapseExample">
                        すべてみる
                    </button>
                </div>
                <div class="collapse" id="favorite" >
                  <div class="card-body row">
                     @for ($i = $top_num; $i < $num; $i++) 
                             @php
                               $favoriting = $favoritings->get($i);
                               $creater = $favoriting->user;
                               $creater_icon = $creater->icon_file_path;
                               $thumbnail = $favoriting->upload_images()->orderBy('id', 'asc')->first();
                               $thumbnail_path = $thumbnail ? $thumbnail->file_path : '';
                             @endphp
                             
                                <div class="col-12 col-sm-6 col-lg-4 my-5">
                                    <div class="bg-white px-3 py-4">
                                        <div class="my-3">
                                         <img src="{{ Storage::url($thumbnail_path) }}" style="width:100%; height:100%;"/>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                @if ($creater_icon == null) 
                                                    <a href="{{ route('users.show', ['user' => $favoriting->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                                        <i class="fas fa-user-circle fa-2x align-middle"></i>
                                                        {{$favoriting->user->name}}
                                                    </a>
                                                @else 
                                                    <a href="{{ route('users.show', ['user' => $favoriting->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                                        <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                                        {{$favoriting->user->name}}
                                                    </a>
                                                @endif
                                            <div>
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
        @else
            <div class="row bg-white mb-5 d-flex align-items-center justify-content-center" style="height: 200px;">
              <h3 class="text-secondary">作品がありません</h3>  
            </div>
        @endif
    @endif
@endif
@if (Auth::check())
    @if (Auth::id() == $user->id)
        
        <div class="row justify-content-center">
            <h3 class="col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center" style="background-color: #FFFF99; ">お気に入り</h3>
        </div>
        @if (count($favoritings) > 0)
            @php
             $num_fav = count($favoritings);
            @endphp
             
                
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
                                    <div class="bg-white px-3 py-4 h-100">
                                       <div class="my-3 d-flex align-items-center justify-content-center" style="height:250px;">
                                            <img src="{{ Storage::url($thumbnail_path) }}" style="max-height: 100%; max-width: 100%;"/>
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
                    <div class="d-block mx-auto">
                        {{ $favoritings->links() }}
                    </div>
                </div>  
            
            
        @else
            <div class="row bg-white mb-5 d-flex align-items-center justify-content-center" style="height: 200px;">
              <h3 class="text-secondary">作品がありません</h3>  
            </div>
        @endif
    @endif
@endif
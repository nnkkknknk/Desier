@if (count($works) > 0)
        <div class="row">
            @for ($i = 0; $i < $num; $i++) 
            
                 @php
                   $work = $works->get($i);
                   $creater = $work->user;
                   $creater_icon = $creater->icon_file_path;
                   $thumbnail = $work->upload_images()->orderBy('id', 'asc')->first();
                   $thumbnail_path = $thumbnail ? $thumbnail->file_path : '';
                 @endphp
                
                    <div class="col-12 col-sm-6 col-lg-4 my-5">
                        <div class="bg-white px-3 py-4 h-100">
                            <div class="my-3 d-flex align-items-center justify-content-center" style="height:250px;">
                                 <img src="{{ asset(Storage::url($thumbnail_path)) }}" style="max-height: 100%; max-width: 100%;"/>
                           </div>
                            <div class="media-body">
                                
                                <div>
                                    
                                    @if ($creater_icon == null) 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <i class="fas fa-user-circle fa-2x align-middle"></i>
                                            {{$work->user->name}}
                                        </a>
                                    @else 
                                        <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                                            <img src="{{ Storage::url($creater_icon) }}" style="width: 30px; height: 30px; border-radius: 100%;"/>
                                            {{$work->user->name}}
                                        </a>
                                    @endif
                                    
                                    
                                </div>
                                
                                <div>
                                    <p class="my-2 mb-0 text-center">{!! link_to_route('works.show',nl2br(e($work->title)), ['work' => $work->id]) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
            @endfor
        </div>  
        <div class="d-flex justify-content-center">
            {{ $works->links() }}
        </div>
@else
    <div class="row bg-white mb-5 d-flex align-items-center justify-content-center" style="height: 200px;">
      <h3 class="text-secondary ">作品がありません</h3>  
    </div>
@endif
    
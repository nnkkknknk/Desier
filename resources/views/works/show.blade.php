@extends('layouts.app')

@section('content')
    @php
         $creater = $work->user;
         $creater_icon = $creater->icon_file_path;
    @endphp
    <div class="row py-3 bg-white mb-5">
        <h2 class="col-12">{{ $work->title }}</h2>
        
        <div class="col-12 my-3" style="display:inline-flex">
            {!! link_to_route('work.download', 'ファイルをダウンロード', ['id' => $work->id], ['class' => 'btn bg-dark text-white rounded-pill col-3 col-lg-2']) !!}
             @include('favorite.favorite_button')
        </div>
     
       
       
       <div class="col-12">
            @if ($creater_icon == null) 
                <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                    <i class="fas fa-user-circle fa-4x align-middle"></i>
                    {{$work->user->name}}
                </a>
                @include('user_follow.follow_button')
            @else 
                <a href="{{ route('users.show', ['user' => $work->user->id]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                    <img src="{{ Storage::url($creater_icon) }}" style="width: 60px; height: 60px; border-radius: 100%;"/>
                    {{$work->user->name}}
                </a>
                @include('user_follow.follow_button')
            @endif
       </div>
       
       <div class="col-12 mt-3">作品説明</div>
       <!--<div class="bg-white col-11 ml-3 mb-3 border" style="height:175px;">-->
       <!--<div style="width: 100%; height: 60px;">-->
       <!--</div>-->
           <div class="bg-white col-10 ml-3 mb-2 border text-break">
              
                {{$work-> description}}
           </div>
       
       <div class="col-12">
           <div class="ml-1">#タグ</div>
            @if(count($tags) > 0)
                <div class="" style="display:inline-flex">
                   @foreach($tags as $keyword)
                    {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'bg-secondary form-inline']) !!}
                        {!! Form::hidden('keyword', $keyword->tag ,['class' => 'form-controll']) !!}
                        <a>
                            {!! Form::submit("#".$keyword->tag, ['class' => 'form-controll bg-white border-0 text-primary']) !!}
                        </a>
                    {!! Form::close() !!}
                   @endforeach
                </div>
                
            @else
                <div>notag</div>
            @endif
       </div>
    </div>
    
    <div class="row mb-5">
        <div class="col-12 bg-white py-3">
             <!--<div style="height: 500px; border: solid;">-->
                @if(count($images) > 0)
                    @php
                     $top_num = 1;
                     $num = count($images);
                    @endphp
                    
                    @if(count($images) <= $top_num)
                        @for ($i = 0; $i < $top_num; $i++) 
                             @php
                               $image = $images->get($i);
                             @endphp
                            <img src="{{ Storage::url($image->file_path) }}"style="width:100%;"/>
                        @endfor
                    @endif
                    
                    @if(count($images) > $top_num)
                        @for ($i = 0; $i < $top_num; $i++) 
                             @php
                               $image = $images->get($i);
                             @endphp
                            <img src="{{ Storage::url($image->file_path) }}" class="mb-2" style="width:100%;"/>
                        @endfor
                        
                        <div class="text-center my-3">
                            <button class="btn rounded-pill bg-dark text-white" type="button" data-toggle="collapse" data-target="#work_show" aria-expanded="false" aria-controls="collapseExample">
                                すべてみる
                            </button>
                        </div>
                        
                        <div class="collapse" id="work_show">
                             <div class="card-body row">
                                @for ($i = $top_num; $i < $num; $i++) 
                                    @php
                                       $image = $images->get($i);
                                     @endphp
                                    <img src="{{ Storage::url($image->file_path) }}" class="mb-5" style="width:100%;"/>
                                @endfor
                            </div>
                        </div>
                    @endif
                @else
                    <div>notag</div>
                @endif

             
             
             
             
        </div>
    </div>
    
    
    <div class="bg-white row py-5 align-items-center justify-content-center">
            
            <div class="col-2 text-right">
                @if (Auth::check())
                         @php
                            $login_user = \Auth::user();
                        @endphp
                    @if ($login_user->icon_file_path == null) 
                        <a href="{{ route('users.show', ['user' => Auth::id()]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                            <i class="fas fa-user-circle fa-3x align-middle"></i>
                        </a>
                    @else 
                        <a href="{{ route('users.show', ['user' => Auth::id()]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                            <img src="{{ Storage::url($login_user->icon_file_path) }}" style="width: 50px; height: 50px; border-radius: 100%;"/>
                        </a>
                    @endif
                 @else
                     <a href="{{ route('login', []) }}" class="{{ Request::routeIs('login') ? 'active' : '' }}">
                            <i class="fas fa-user-circle fa-2x align-middle"></i>
                    </a>
    
                 @endif
            </div>
            
            {!!Form::model($comment, ['method'=>'post', 'route'=>['comments.store', $work->id], 'class'=>'col-10 row' ]) !!}
            
            
            <div class="col-10">{!! Form::textarea('content', null, ['class' => 'form-control','placeholder' => 'コメントを追加','rows' => '2']) !!}</div>
            {!! Form::hidden('work_id', $work->id) !!}
            <div class="text-left col-2 mt-3">{!! Form::submit('送信', ['class' => 'btn btn-primary']) !!}</div>
            {!! Form::close() !!}
        
        
    </div>
     @include('works.comment_list')
    
    

@endsection
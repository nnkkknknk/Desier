@extends('layouts.app')

@section('content')
@php
    $icon = $user->icon_file_path;
@endphp
   
    <div class="bg-white my-3 mx-1 py-2">
        <div>
            @if ($icon == null) 
                <div class="mx-2 d-flex">
                     <div class="d-inline-block mr-2">
                         <i class="fas fa-user-circle fa-5x align-middle my-3 mx-3"></i>
                    </div>
                    <div class="d-inline-block my-auto ">
                        <h4>
                            {{$user->name}}
                        </h4>
                    </div>
                </div>
            @else 
                <div class="mx-2 d-flex">
                     <div class="d-inline-block mr-2">
                        <img src="{{ Storage::url($icon) }}" class="my-3" style="width: 75px; height: 75px; border-radius: 100%;"/>
                    </div>
                    <div class="d-inline-block my-auto">
                        <h4>
                            {{$user->name}}
                        </h4>
                        
                    </div>
                </div>
            @endif
        </div>
        
        <div>
            <div class="mx-2 d-flex">
                <div class="d-inline-block">
                    <div class="mx-3">
                        @if ($user->followings_count == 0)
                            <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="{{ Request::routeIs('users.followings') ? 'active' : '' }}">
                               0フォロー
                            </a>
                        @else
                            <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="{{ Request::routeIs('users.followings') ? 'active' : '' }}">
                               {{ $user->followings_count }} フォロー
                            </a>
                        @endif
                    </div>
                    
                    <div class="mx-3">
                        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="{{ Request::routeIs('users.followers') ? 'active' : '' }}">
                             {{ $user->followers_count }}
                        フォロワー
                        </a>
                    </div>
                    
                </div>
                
                
                <div class="d-inline-block my-auto ">
                    @if (Auth::check())
                        @if (Auth::id() == $user->id)
                            {!! link_to_route('users.edit', 'プロフィール編集', ['user' => Auth::id()], ['class' => 'mr-2 btn btn-secondary']) !!}
                        @else
                            @include('user_follow.follow_button')
                        @endif
                    @else
                    @endif
                </div>
                
            </div>
            
            
        </div>
        <div class="mx-4 pt-3 pb-2">
            {{$user->self_information}}
        </div>
    </div>
    
    <div class="row justify-content-center">
        <h3 class="col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center" style="background-color: rgb(70, 225, 70); ">投稿一覧</h3>
    </div>
    
    
    
    {{-- 投稿一覧 --}}
    <div class="mx-3">
        @include('works.works')
    </div>
    <div class="mx-3">
        @include('favorite.favorite')
    </div>
    
@endsection
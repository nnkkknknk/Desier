@extends('layouts.app')

@section('content')
@php
    $icon = $user->icon_file_path;
@endphp
   
    <div class="row bg-white my-5 mx-1">
        <div class="col-2">
            @if ($icon == null) 
                <i class="fas fa-user-circle fa-5x align-middle my-3 mx-3"></i>
            @else 
            <div style="width: 90px; height: 90px;">
                <img src="{{ Storage::url($icon) }}" class="my-3" style="width: 100%; height: 100%; border-radius: 100%;"/>
            </div>
            @endif
        </div>
        
        <div class="col-5 d-flex align-items-center color: rgb(70, 225, 70)">
            <div>
                <h4 class="offset-1 offset-md-0 col-12 pl-2">{{ $user->name }}</h4>
                <div class="offset-1 col-12">
                    
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
                <div class="offset-1 col-12">
                    <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="{{ Request::routeIs('users.followers') ? 'active' : '' }}">
                         {{ $user->followers_count }}
                    フォロワー
                    </a>
                </div>
                
            </div>
            
        </div>
        
        <div class="col-5 d-flex align-items-center">
            @if (Auth::check())
                @if (Auth::id() == $user->id)
                    {!! link_to_route('users.edit', 'プロフィール編集', ['user' => Auth::id()], ['class' => 'mr-2 btn btn-secondary']) !!}
                @else
                
                    @include('user_follow.follow_button')
                @endif
            @else
            @endif
        </div>
        <div class="offset-2 col-8 mb-4 pl-5">
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
    
    <!--<div class="my-5 text-center">-->
    <!--    <button class="rounded-pill bg-dark text-white">すべてみる</button>-->
    <!--</div>-->
    
    <!--<div class="row">-->
    <!--    <div class="col-sm-8">-->
    <!--        <ul class="nav nav-tabs nav-justified mb-3">-->
                
    <!--            {{-- ユーザ詳細タブ --}}-->
    <!--            <li class="nav-item">-->
    <!--                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">-->
    <!--                    TimeLine-->
    <!--                    <span class="badge badge-secondary">{{ $user->titles_count }}</span>-->
    <!--                </a>-->
    <!--            </li>-->
                
    <!--            {{-- フォロー一覧タブ --}}-->
    <!--            <li class="nav-item rounded-pill bg-primary col-3 d-flex align-items-center justify-content-center py-3 mr-3"><a class="text-white" href="#" class="nav-link">フォロー中</a></li>-->
    <!--            <li class="nav-item rounded-pill bg-secondary col-3 d-flex align-items-center justify-content-center py-3 mr-3"><a class="text-white" href="#" class="nav-link">フォロワー</a></li>-->
    
    <!--        </ul>-->
    <!--    </div>-->
    <!--</div>-->
    
    <!--{{-- フォロー／アンフォローボタン --}}-->
    <!--        include('user_follow.follow_button')-->
            
    <!--<div class="row">-->
        
    <!--    <div class="col-sm-8">-->
    <!--        {{-- タブ --}}-->
    <!--        include('users.navtabs')-->
           
            
    <!--    </div>-->
    <!--</div>-->
    <!--<div>-->
    <!--    @if (Auth::id() == $user->id)-->
    <!--            {{-- 投稿フォーム --}}-->
    <!--            include('works.form')-->
    <!--    @endif-->
           
    <!--</div>-->
@endsection
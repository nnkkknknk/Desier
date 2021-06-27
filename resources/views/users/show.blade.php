@extends('layouts.app')

@section('content')
@php
    $icon = $user->icon_file_path;
@endphp
   
    <div class="row bg-white mb-5">
        <div class="col-2">
            @if ($icon == null) 
                <i class="fas fa-user-circle fa-5x align-middle my-3 mx-3 bg-p"></i>
            @else 
            <div  style="width: 100px; height: 100px;">
                <img src="{{ Storage::url($icon) }}" class="my-3" style="width: 100%; height: 100%; border-radius: 100%;"/>
            </div>
            @endif
        </div>
        
        <div class="col-5 d-flex align-items-center">
            <div>
                <h3 class="offset-1 ml-4">{{ $user->name }}</h3>
                <div class="offset-1 ml-3 col-12">
                    
                    @if ($user->followings_count == 0)
                        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="{{ Request::routeIs('users.followings') ? 'active' : '' }}">
                           0フォロー
                        </a>
                    @else
                        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="{{ Request::routeIs('users.followings') ? 'active' : '' }}">
                           {{ $user->followings_count }} フォロー
                        </a>
                    @endif
                    
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
        <div class="offset-3 col-9 mb-4">
            {{$user->self_information}}
        </div>
    </div>
    
    <p class="title" style="background-color: rgb(180, 240, 180);">投稿一覧</p>
    
    
    {{-- 投稿一覧 --}}
    @include('works.works')
    @include('favorite.favorite')
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
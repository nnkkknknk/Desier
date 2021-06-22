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
                <img src="{{ Storage::url($icon) }}" style="width: 100px; height: 100px; border-radius: 100%;"/>
        
            @endif
        </div>
        <!--@php-->
        <!--    dd($user->followings_count);-->
        <!--@endphp-->
        <div class="col-7 d-flex align-items-center">
            <div>
                <h3 class="ml-2">{{ $user->name }}</h3>
                <div class="col-12">
                    
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
        
        <div class="col-3 d-flex align-items-center">
            {!! link_to_route('users.edit', 'プロフィール編集', ['user' => Auth::id()], ['class' => 'mr-2 btn btn-secondary']) !!}
            <!--<button class="mr-2 btn btn-secondary" type="submit">プロフィール編集</button>-->
        </div>
    </div>
    <div></div>
    
    <p class="title" style="background-color: #72c272;">投稿一覧</p>
    
    
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
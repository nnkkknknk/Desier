@extends('layouts.app')

@section('content')
   @if (Auth::check())
        <!--<h>toppage</h> -->
        <!--{{ Auth::user()->name }}-->
        <div class="text-center">
                <h3 class="offset-4 offset-lg-5 col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill">おすすめ作品</h3>
                {{-- ユーザ登録ページへのリンク --}}
                <!--{!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary']) !!}-->
                <!--{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary']) !!}-->
        </div>
            
            {{-- 作品一覧 --}}
            @include('works.works')
        
    @else
        <!--<div class="center jumbotron">-->
        <div class="text-center bg-white py-4 ">
            <h2 class="">ようこそ、Desierへ</h2>
            {!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary rounded-pill']) !!}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary rounded-pill']) !!}
        </div>
            <div class="text-center">
                <h3 class="offset-4 offset-lg-5 bg-white col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill">おすすめ作品</h3>
                {{-- ユーザ登録ページへのリンク --}}
            </div>
       
         {{-- 作品一覧 --}}
        @include('works.works')
    @endif
    
   
@endsection
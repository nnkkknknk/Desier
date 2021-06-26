@extends('layouts.app')

@section('content')
   @if (Auth::check())
        <!--<h>toppage</h> -->
        {{ Auth::user()->name }}
        <h1 class="text-center bg-white w-25">おすすめ作品</h1>
            <!--<p class="text-center bg-white w-25">新着</p>-->
            
            {{-- 作品一覧 --}}
            @include('works.works')
        
    @else
        <!--<div class="center jumbotron">-->
            <div class="text-center">
                <!--<h1>Welcome to the Microposts</h1>-->
                <h2 class="offset-4 offset-lg-5 bg-white col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill">おすすめ作品</h2>
                {{-- ユーザ登録ページへのリンク --}}
                <!--{!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary']) !!}-->
                <!--{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary']) !!}-->
            </div>
        <!--    <h>toppage</h>-->
        <!--    <p class="text-center bg-white w-25">新着</p>-->
           
             
        <!--</div>-->
        <!--<div class="center">-->
        <!--    <div class='text-center'>-->
        <!--        <h2 class="bg-white">おすすめ作品</h2>-->
        <!--    </div>-->
        <!--</div>-->
        
         {{-- 作品一覧 --}}
        @include('works.works')
    @endif
    
   
@endsection
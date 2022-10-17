@extends('layouts.app')

@section('content')
   @if (Auth::check())
        <div class="text-center bg-white py-4 mt-5">
            <h2 class="">ようこそ、Desierへ</h2>
            <div class="mx-5 px-4">
                <p class="text-dark">
                    Desierは、Webデザイン共有サイトです。<br>
                    Webデザインの投稿、閲覧、コードのダウンロードを行うことができます。
                </p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <h3 class="bg-white col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center">おすすめ作品</h3>
        </div>
            
            {{-- 作品一覧 --}}
            @include('works.works')
        
    @else
        <!--<div class="center jumbotron">-->
        <div class="text-center bg-white py-4 mt-5">
            <h2 class="">ようこそ、Desierへ</h2>
            <div class="mx-5 px-4">
                <p class="text-dark">
                    Desierは、Webデザイン共有サイトです。<br>
                    Webデザインの投稿、閲覧、コードのダウンロードを行うことができます。
                </p>
            </div>
            
            {!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary rounded-pill']) !!}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary rounded-pill']) !!}
        </div>
        <div class="row justify-content-center">
            <h3 class="bg-white col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center">おすすめ作品</h3>
        </div>
       
         {{-- 作品一覧 --}}
        @include('works.works')
    @endif
    
   
@endsection
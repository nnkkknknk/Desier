@extends('layouts.app')

@section('content')
   @if (Auth::check())
        <div class="text-center bg-white pt-4 pb-2 mt-5">
            <h1 class="mb-4">ようこそ、Desierへ</h1>
            
            <div class="row justify-content-center my-3">
                <button class="btn btn-link bg-white rounded-pill text-center text-dark" type="button" data-toggle="collapse" data-target="#mypost" aria-expanded="false" aria-controls="collapseExample">
                        <h5>
                            Desierとは <i class="fas fa-caret-down"></i>
                        </h5>
                </button>
            </div>
            <div class="collapse mx-5 px-4" id="mypost">
                <h6 class="text-dark">
                    Desierは、Webデザイン共有サイトです。
                </h6>
                <h6 class="text-dark">
                    Webデザインの投稿、閲覧、html・css・javascriptコードのダウンロードを行うことができます。
                </h6>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <h3 class="bg-white col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center">おすすめ作品</h3>
        </div>
            
            {{-- 作品一覧 --}}
            @include('works.works')
        
    @else
        <!--<div class="center jumbotron">-->
        <div class="text-center bg-white pt-4 pb-2 mt-5">
            <h1 class="mb-4">ようこそ、Desierへ</h1>
            
            {!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-sm btn-primary rounded-pill']) !!}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-sm ml-3 btn-secondary rounded-pill']) !!}
            <div class="row justify-content-center my-3">
                <button class="btn btn-link bg-white rounded-pill text-center text-dark" type="button" data-toggle="collapse" data-target="#mypost" aria-expanded="false" aria-controls="collapseExample">
                        <h5>
                            Desierとは <i class="fas fa-caret-down"></i>
                        </h5>
                            
                </button>
            </div>
            <div class="collapse mx-5 px-4" id="mypost">
                <h6 class="text-dark">
                    Desierは、Webデザイン共有サイトです。
                </h6>
                <h6 class="text-dark">
                    Webデザインの投稿、閲覧、html・css・javascriptコードのダウンロードを行うことができます。
                </h6>
                
            </div>
            
            
        </div>
        <div class="row justify-content-center">
            <h3 class="bg-white col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center">おすすめ作品</h3>
        </div>
       
         {{-- 作品一覧 --}}
         <div class="mx-3">
            @include('works.works')
         </div>
    @endif
    
   
@endsection
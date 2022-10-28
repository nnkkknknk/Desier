@extends('layouts.app')

@section('content')
    @if (Auth::check())
        
        <div class="bg-white text-center mx-3 py-3">
           <h3>
               ＃検索結果
           </h3> 
               <div class="" >
                   
                   @foreach($keywords as $keyword)
                    {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'form-inline']) !!}
                        {!! Form::hidden('keyword', $keyword ,['class' => 'form-controll']) !!}
                        <a>
                            {!! Form::submit($keyword, ['class' => 'form-controll border-0 bg-white text-primary text-wrap']) !!}
                        </a>
                    {!! Form::close() !!}
                   @endforeach
               </div>
        </div>
        <div class="row justify-content-center">
                <h3 class="bg-white col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center">おすすめ作品</h3>
        </div>
        <!--<p class="text-center bg-white w-25">おすすめ作品</p>-->
        <!--    <p class="text-center bg-white w-25">新着</p>-->
            
            {{-- 作品一覧 --}}
        <div class="mx-3">
            @include('works.worksallbutton')
        </div>
        
    @else
        <div class="bg-white text-center mx-3 py-3">
           
           <h3>
               ＃検索結果
           </h3> 
               <div class="" >
                   
                   @foreach($keywords as $keyword)
                    {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'form-inline']) !!}
                        {!! Form::hidden('keyword', $keyword ,['class' => 'form-controll']) !!}
                        <a>
                            {!! Form::submit($keyword, ['class' => 'form-controll border-0 bg-white text-primary text-wrap']) !!}
                        </a>
                    {!! Form::close() !!}
                   @endforeach
               </div>
        </div>
        
        <div class="row justify-content-center">
                <h3 class="bg-white col-5 col-lg-3 shadow-sm py-3 mt-5 rounded-pill text-center">おすすめ作品</h3>
        </div>
        
        <!--<div class="text-center">-->
        <!--        <h3 class="offset-4 offset-lg-5 bg-white col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill">おすすめ作品</h3>-->
        <!--        {{-- ユーザ登録ページへのリンク --}}-->
                <!--{!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary']) !!}-->
                <!--{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary']) !!}-->
        <!--</div>-->
        
         {{-- 作品一覧 --}}
        @include('works.worksallbutton')
    @endif

@endsection
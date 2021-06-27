@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <!--{{ Auth::user()->name }}-->
        <div class="bg-white text-center py-3">
           
           <h2>
               ＃検索結果:
               <div class="" style="display:inline-flex">
                   
                   @foreach($keywords as $keyword)
                    {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'bg-secondary form-inline']) !!}
                        {!! Form::hidden('keyword', $keyword ,['class' => 'form-controll']) !!}
                        <a>
                            {!! Form::submit($keyword, ['class' => 'form-controll bg-white border-0 text-primary']) !!}
                        </a>
                    {!! Form::close() !!}
                   @endforeach
               </div>
           </h2> 
        </div>
        <div class="text-center">
                <h3 class="offset-4 offset-lg-5 bg-white col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill">おすすめ作品</h3>
                {{-- ユーザ登録ページへのリンク --}}
                <!--{!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary']) !!}-->
                <!--{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary']) !!}-->
        </div>
        <!--<p class="text-center bg-white w-25">おすすめ作品</p>-->
        <!--    <p class="text-center bg-white w-25">新着</p>-->
            
            {{-- 作品一覧 --}}
            @include('works.works')
        
    @else
        <div class="bg-white text-center py-3">
           
           <h2>
               ＃検索結果:
               <div class="" style="display:inline-flex">
                   
                   @foreach($keywords as $keyword)
                    {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'bg-secondary form-inline']) !!}
                        {!! Form::hidden('keyword', $keyword ,['class' => 'form-controll']) !!}
                        <a>
                            {!! Form::submit($keyword, ['class' => 'form-controll bg-white border-0 text-primary']) !!}
                        </a>
                    {!! Form::close() !!}
                   @endforeach
               </div>
           </h2> 
        </div>
        
        <div class="text-center">
                <h3 class="offset-4 offset-lg-5 bg-white col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill">おすすめ作品</h3>
                {{-- ユーザ登録ページへのリンク --}}
                <!--{!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-md btn-primary']) !!}-->
                <!--{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-md ml-3 btn-secondary']) !!}-->
        </div>
        
         {{-- 作品一覧 --}}
        @include('works.works')
    @endif

@endsection
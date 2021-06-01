@extends('layouts.app')

@section('content')
   @if (Auth::check())
        <h>toppage</h> 
        {{ Auth::user()->name }}
        <p class="text-center bg-white w-25">おすすめ作品</p>
            <p class="text-center bg-white w-25">新着</p>
            
        
    @else
        <div class="center jumbotron">
            <!--<div class="text-center">-->
            <!--    <h1>Welcome to the Microposts</h1>-->
            <!--    {{-- ユーザ登録ページへのリンク --}}-->
            <!--    {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}-->
            <!--</div>-->
            <h>toppage</h>
            <p class="text-center bg-white w-25">おすすめ作品</p>
            <p class="text-center bg-white w-25">新着</p>
           
             
        </div>
    @endif
    
    {{-- 作品一覧 --}}
    @include('works.works')
@endsection
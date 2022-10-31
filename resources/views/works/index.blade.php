@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    @if (Auth::check())
        <h>toppage</h> 
        {{ Auth::user()->name }}
        <p class="text-center bg-white w-25">おすすめ作品</p>
            <p class="text-center bg-white w-25">新着</p>
            
             {{-- 作品一覧 --}}
    @include('works.works')
        
    @else
        <div class="center jumbotron">
            <h>toppage</h>
            <p class="text-center bg-white w-25">おすすめ作品</p>
            <p class="text-center bg-white w-25">新着</p>
           
             
        </div>
        
         {{-- 作品一覧 --}}
    @include('works.works')
    @endif
@endsection

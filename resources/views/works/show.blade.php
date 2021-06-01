@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-7 bg-white">
             <div style="height: 500px; border: solid;">
                       
             </div>
             
        </div>
        <div class="col-5">
            <!--<h1>id = {{ $work->id }} のメッセージ詳細ページ</h1>-->
            <h2>{{ $work->title }}</h2>
            
            <div>
                {{-- フォロー／アンフォローボタン --}}
            @include('favorite.favorite_button')
                {!! link_to_route('works.create', 'お気に入り☆', [], ['class' => 'btn bg-warning rounded-pill' ] )!!}
                {!! link_to_route('works.create', 'ダウンロード', [], ['class' => 'btn bg-dark text-white rounded-pill']) !!}
                 
            </div>
            <div class="mt-3">
               @include('user_follow.follow_button')
           </div>
           
           <p>作者のコメント</p>
           <div class="mt-3 bg-white">
               {{$work-> description}}
           </div>
          
            <!--<table class="table table-bordered">-->
            <!--    <tr>-->
            <!--        <th>id</th>-->
            <!--        <td>{{ $work->id }}</td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <th>メッセ</th>-->
            <!--        <td>{{ $work->title }}</td>-->
            <!--    </tr>-->
            <!--</table>-->
        </div>
        
    </div>
    

@endsection
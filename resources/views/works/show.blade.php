@extends('layouts.app')

@section('content')
<!--@php-->
<!--dd($images);-->
<!--@endphp-->
    <div class="row">
        <div class="col-8 bg-white">
             <!--<div style="height: 500px; border: solid;">-->
                @if(count($images) > 0)
                    @php
                     $image_num = count($images);
                    @endphp
                    @foreach ($images as $image)
            
                        <img src="{{ Storage::url($image->file_path) }}" style="width:100%;"/>
                    @endforeach
                    
                @else
                    <div>notag</div>
                @endif

             <div class="bg-dark">
                 
                @if(count($codes) > 0)
                    @foreach ($codes as $code)
                       <a>
                           {{Storage::url($code->file_path)}}
                       </a> 
                        
                    @endforeach
                    
                @else
                    <div>notag</div>
                @endif
             </div>
             
        </div>
        <div class="col-4">
            <!--<h1>id = {{ $work->id }} のメッセージ詳細ページ</h1>-->
            <h2>{{ $work->title }}</h2>
            
            <div>
                {{-- フォロー／アンフォローボタン --}}
            @include('favorite.favorite_button')
                {!! link_to_route('works.create', 'お気に入り☆', [], ['class' => 'btn bg-warning rounded-pill' ] )!!}
                {!! link_to_route('work.download', 'ダウンロード', ['id' => $work->id], ['class' => 'btn bg-dark text-white rounded-pill']) !!}
                 
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
            @if(count($tags) > 0)
                @foreach ($tags as $tag)
                <!--<div>{{$tag->tag}}</div>-->
                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                    {!! link_to_route('users.show',$tag->tag, ['user' => $work->user->id]) !!}
                @endforeach
                
            @else
                <div>notag</div>
            @endif
        </div>
        
    </div>
    

@endsection
@if (count($work->comment) == 0)
    <div class="row bg-white border-top py-5 mb-5">
        <h5 class="text-secondary text-center col-12">コメントがありません</h3>  
    </div>
    
@else
@foreach ($work->comment as $comment)
@php
 $commenter = $comment -> user;
@endphp
  <div class="row bg-white">
    
    <div class="col-2 text-right">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        @if ($commenter->icon_file_path == null) 
            <i class="fas fa-user-circle fa-3x align-middle my-3 mx-3 bg-p"></i>
        @else 
            <img src="{{ Storage::url($commenter->icon_file_path) }}" style="width: 50px; height: 50px; border-radius: 100%;"/ class="mx-3 my-3">
        @endif
    </div>
    
    <div class="col-10 bg-white mb-3">
        <div>
            {!! link_to_route('users.show', $commenter->name, ['user' => $comment->user_id]) !!}
            {{$comment->updated_at}}
        </div>
        <div>
            {{$comment->content}}
        </div>
    </div>
 </div>
@endforeach
@endif
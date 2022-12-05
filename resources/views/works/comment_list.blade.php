@if (count($work->comment) == 0)
    <div class="row bg-white py-5 mb-5 mx-2">
        <h5 class="text-secondary text-center col-12">コメントがありません</h3>  
    </div>
    
@else
@foreach ($work->comment as $comment)
@php
 $commenter = $comment -> user;
@endphp
  <div class="row bg-white mx-2">
    
    <div class="col-12">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        @if ($commenter->icon_file_path == null) 
            <div class="d-flex mx-2">
                <div class="d-inline-block mr-2">
                    <i class="fas fa-user-circle fa-3x align-middle my-3 mx-3 bg-p"></i>
                </div>
                <div class="d-inline-block my-auto">
                    <div>
                        {!! link_to_route('users.show', $commenter->name, ['user' => $comment->user_id]) !!}
                    </div>
                    <div>
                        {{$comment->updated_at}}
                    </div>
                    <div>
                        {{$comment->content}}
                    </div>
                </div>
                
            </div>
        @else 
            <div class="d-flex mx-2">
                <div class="d-inline-block mr-2">
                    <img src="{{ Storage::url($commenter->icon_file_path) }}" style="width: 50px; height: 50px; border-radius: 100%;"/ class="mx-3 my-3">
                </div>
                <div class="d-inline-block my-auto">
                    <div>
                        {!! link_to_route('users.show', $commenter->name, ['user' => $comment->user_id]) !!}
                    </div>
                    <div>
                        {{$comment->updated_at}}
                    </div>
                    
                    <div>
                        {{$comment->content}}
                    </div>
                    
                </div>
                
            </div>
        @endif
    </div>
 </div>
@endforeach
@endif
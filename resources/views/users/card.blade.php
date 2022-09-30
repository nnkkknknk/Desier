<div class="card mb-2">
    
    <div class="card-body text-center border-0">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <!--<img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">-->
        @if ($user->icon_file_path == null) 
            <i class="fas fa-user-circle fa-5x align-middle my-3 mx-3 bg-p"></i>
        @else 
            <img src="{{ Storage::url($user->icon_file_path) }}" style="width: 100px; height: 100px; border-radius: 100%;"/>
        @endif
    </div>
    <div class="card-header border-0 bg-white">
        <h3 class="card-title text-center">
            {!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}
        </h3>
    </div>
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')
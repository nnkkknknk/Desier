@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media bg-white py-3 px-3 border-bottom mb-1">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                @if ($user->icon_file_path == null) 
                    <i class="fas fa-user-circle fa-5x align-middle my-3 mx-3 bg-p"></i>
                @else 
                    <img src="{{ Storage::url($user->icon_file_path) }}" style="width: 100px; height: 100px; border-radius: 100%;"/>
            
                @endif
                <div class="media-body row">
                    <div class="col-12">
                        {{-- ユーザ詳細ページへのリンク --}}
                        <h4 class="pl-3">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h4>
                    </div>
                    
                    <div class="col-10 col-sm-10 col-lg-5">
                        @include('user_follow.follow_button')
                    </div>
                    <div class="offset-1 mt-3 mr-5">
                        {{$user->self_information}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    
    {{-- ページネーションのリンク --}}
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@else
    <li class="media bg-white py-3 px-3 border-bottom mb-1 d-flex align-items-center justify-content-center" style="height: 200px;">
      <h3 class="text-secondary ">フォロー&フォロワーを増やそう</h3>  
    </li>
@endif

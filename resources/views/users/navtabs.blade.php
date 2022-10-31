<ul class="nav nav-tabs nav-justified mb-3">
        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link bg-primary text-white border-0 rounded-pill {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            フォロー中
             <span class="badge badge-white">{{ $user->followings_count }}</span>
        </a>
    {{-- フォロワー一覧タブ --}}
        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link bg-secondary text-white border-0 rounded-pill {{ Request::routeIs('users.followers') ? 'active' : '' }}">
           フォロワー
            <span class="badge badge-white">{{ $user->followers_count }}</span>
        </a>
</ul>
<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ詳細タブ --}}
    <!--<li class="nav-item rounded-pill bg-primary col-4 d-flex align-items-center justify-content-center py-3 mr-3">-->
    <!--    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link text-white {{ Request::routeIs('users.show') ? 'active' : '' }}">-->
    <!--        TimeLine-->
    <!--        <span class="badge badge-secondary">{{ $user->microposts_count }}</span>-->
    <!--    </a>-->
    <!--</li>-->
    {{-- フォロー一覧タブ --}}
    <li class="nav-item rounded-pill bg-primary col-4 d-flex align-items-center justify-content-center py-3 mr-3">
        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link bg-primary text-white border-0 {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            フォロー中
             <span class="badge badge-secondary">{{ $user->followings_count }}</span>
        </a>
    </li>
   
    {{-- フォロワー一覧タブ --}}
    <li class="nav-item rounded-pill bg-secondary col-4 d-flex align-items-center justify-content-center py-3 mr-3">
        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link bg-secondary text-white border-0 {{ Request::routeIs('users.followers') ? 'active' : '' }}">
           フォロワー
            <span class="badge badge-secondary">{{ $user->followers_count }}</span>
        </a>
        
    </li>
</ul>

<!--<div class="row">-->
<!--        <div class="col-sm-8">-->
<!--            <ul class="nav nav-tabs nav-justified mb-3">-->
<!--                {{-- フォロー一覧タブ --}}-->
<!--                <li class="nav-item rounded-pill bg-primary col-3 d-flex align-items-center justify-content-center py-3 mr-3"><a class="text-white" href="#" class="nav-link">フォロー中</a></li>-->
<!--                <li class="nav-item rounded-pill bg-secondary col-3 d-flex align-items-center justify-content-center py-3 mr-3"><a class="text-white" href="#" class="nav-link">フォロワー</a></li>-->
    
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
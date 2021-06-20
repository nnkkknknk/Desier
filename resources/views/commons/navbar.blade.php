
<header class="mb-4">
    <nav class="navbar navbar-light bg-white border border-bottom">
        
        <div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- トップページへのリンク --}}
            <!--<a class="navbar-brand text-primary text-left " href="/">Original</a>-->
             {!! link_to_route('top', 'Original', [], ['class' => 'navbar-brand text-primary text-left ']) !!}
        </div>
        <div class="col-3 d-flex align-items-center rounded-pill shadow-sm" >
            <i class="fas fa-search mr-1"></i>
            <input type="text" class="search form-control border-0" size="10" placeholder="作品を検索">
        </div>
       
       <div class="float-right d-none d-sm-block mr-5">
            {{-- メッセージ作成ページへのリンク --}}
             {!! link_to_route('works.create', '作品を投稿', [], ['class' => 'btn btn-primary']) !!}

            
            <div class="dropdown d-inline-block mr-5">
                
                @if ($user->icon_file_path == null) 
                    <i class="fas fa-user-circle fa-2x align-middle"></i>
                @else 
                    <a href="{{ route('users.show', ['user' => Auth::id()]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                        <img src="{{ Storage::url($user->icon_file_path) }}" style="width: 50px; height: 50px; border-radius: 100%;"/>
                    </a>
                @endif
                
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"></button>
                <!-- 選択肢 -->
                <div class="dropdown-menu">
                    
                    @if (Auth::check())
                       {{-- ユーザ詳細ページへのリンク --}} 
                        <li class="dropdown-item">
                            {!! link_to_route('users.show', Auth::user()->name, ['user' => Auth::id()], ['class' => 'text-secondary']) !!}
                        </li>
                        <li class="dropdown-item">
                           {!! link_to_route('users.followings', 'フォロー&フォロワー', ['id' => $user->id], ['class' => 'text-secondary']) !!}
                        </li>
                        <li class="dropdown-item">
                           {!! link_to_route('users.edit', 'プロフィール編集', ['user' => Auth::id()], ['class' => 'text-secondary']) !!}
                        </li>
                        <li class="dropdown-divider"></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト', '', ['class' => 'text-dark']) !!}</li>
                        
                     @else
                        {{-- ユーザ登録ページへのリンク --}}
                        <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link text-dark']) !!}</li>
                        {{-- ログインページへのリンク --}}
                        <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                     @endif
                    
                    <!--<div class="dropdown-divider"></div>-->
                    <!--<a class="dropdown-item" href="#">削除</a>-->
                    
                </div>
            </div>
            
       </div>
       
      
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item"><a href="#" class="nav-link">Users</a></li>
                    <li class="nav-item"><a href="/" class="text-left" >toppage</a></li>
                    
                    <!--<li class="nav-item dropdown">-->
                    <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>-->
                       <!--<ul class="dropdown-menu dropdown-menu-right">-->
                       <!--     {{-- ユーザ詳細ページへのリンク --}}-->
                       <!--     <li class="dropdown-item">{!! link_to_route('users.show', 'My profile', ['user' => Auth::id()]) !!}</li>-->
                       <!--     <li class="dropdown-divider"></li>-->
                       <!--     {{-- ログアウトへのリンク --}}-->
                       <!--     <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>-->
                       <!-- </ul>-->
                    <!--</li>-->
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link text-dark']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>
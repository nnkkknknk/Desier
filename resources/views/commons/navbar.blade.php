<header class="mb-4">
    <nav class="navbar navbar-light navbar-expand-md bg-white border border-bottom row">
        
        <div class="col-4">
            <!--<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">-->
            <!--    <span class="navbar-toggler-icon"></span>-->
            <!--</button>-->
            
            {{-- トップページへのリンク --}}
            <!--<a class="navbar-brand text-primary text-left " href="/">Original</a>-->
             {!! link_to_route('top', 'Desier', [], ['class' => 'navbar-brand text-primary']) !!}
        </div>
        <div class="col-4">
            {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'bg-secondary']) !!}
            <div class="d-flex align-items-center rounded-pill shadow-sm pr-4" >
               
                 <i class="fas fa-search ml-3">
                </i>
                    {!! Form::text('keyword', null, ['class' => 'form-control border-0','placeholder'=>"作品を検索"]) !!}
                
            </div>
            {!! Form::close() !!}
        </div>
        
       <!--<div class="float-right  mr-5 ">-->
       <!--<div class="col-2 d-sm-block d-none">-->
       <!--     {{-- メッセージ作成ページへのリンク --}}-->
       <!--      {!! link_to_route('works.create', '作品を投稿', [], ['class' => ' btn btn-success']) !!}-->
       <!-- </div>-->
        
            <div class="dropdown col-3 offset-1 text-right">
             @if (Auth::check())
                     @php
                        $login_user = \Auth::user();
                    @endphp
                @if ($login_user->icon_file_path == null) 
                    <a class="text-decoration-none" href="{{ route('users.show', ['user' => Auth::id()]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}" >
                        <i class="fas fa-user-circle fa-2x align-middle"></i>
                    </a>
                @else 
                    <a class="text-decoration-none" href="{{ route('users.show', ['user' => Auth::id()]) }}" class="{{ Request::routeIs('users.show') ? 'active' : '' }}">
                        <img src="{{ Storage::url($login_user->icon_file_path) }}" style="width: 40px; height: 40px; border-radius: 100%;"/>
                    </a>
                @endif
             @else
             <a class="text-decoration-none" href="{{ route('login', []) }}" class="{{ Request::routeIs('login') ? 'active' : '' }}">
                        <i class="fas fa-user-circle fa-2x align-middle"></i>
                </a>

             @endif
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"></button>
                <!-- 選択肢 -->
                <div class="dropdown-menu dropdown-menu-right">
                    
                    @if (Auth::check())
                       {{-- ユーザ詳細ページへのリンク --}} 
                        
                        <li class="dropdown-item">
                            {!! link_to_route('users.show', Auth::user()->name, ['user' => Auth::id()], ['class' => 'text-secondary']) !!}
                        </li>
                        
                        <li class="dropdown-item">
                            {!! link_to_route('works.create', '作品を投稿', [], ['class' => 'text-success']) !!}
                        </li>
                        
                        <li class="dropdown-item">
                           {!! link_to_route('users.followings', 'フォロー&フォロワー', ['id' => Auth::id()], ['class' => 'text-secondary']) !!}
                        </li>
                        <li class="dropdown-item">
                           {!! link_to_route('users.edit', 'プロフィール編集', ['user' => Auth::id()], ['class' => 'text-secondary']) !!}
                        </li>
                       
                        
                        
                        <li class="dropdown-divider"></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト', '', ['class' => 'text-dark']) !!}</li>
                        
                     @else
                        
                       
                        {{-- ユーザ登録ページへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('signup.get', 'アカウント作成', [], ['class' => 'text-dark']) !!}</li>
                         {{-- ログインページへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('login', 'ログイン', [], ['class' => '']) !!}</li>
                        {{-- 作品投稿へのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('works.create', '作品を投稿', [], ['class' => 'text-success']) !!}</li>
                     @endif
                    
                    <!--<div class="dropdown-divider"></div>-->
                    <!--<a class="dropdown-item" href="#">削除</a>-->
                    
                </div>
            </div>
       
       
       
      
        <!--<div class="collapse navbar-collapse" id="nav-bar">-->
        <!--    <ul class="navbar-nav mr-auto"></ul>-->
        <!--    <ul class="navbar-nav">-->
        <!--        @if (Auth::check())-->
        <!--            {{-- ユーザ一覧ページへのリンク --}}-->
        <!--            <li class="nav-item"><a href="#" class="nav-link">Users</a></li>-->
        <!--            <li class="nav-item"><a href="/" class="text-left" >toppage</a></li>-->
                    
        <!--            <li class="nav-item dropdown">-->
        <!--                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>-->
        <!--               <ul class="dropdown-menu dropdown-menu-right">-->
        <!--                    {{-- ユーザ詳細ページへのリンク --}}-->
        <!--                    <li class="dropdown-item">{!! link_to_route('users.show', 'My profile', ['user' => Auth::id()]) !!}</li>-->
        <!--                    <li class="dropdown-divider"></li>-->
        <!--                    {{-- ログアウトへのリンク --}}-->
        <!--                    <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--        @else-->
                    <!--{{-- ユーザ登録ページへのリンク --}}-->
                    <!--<li class="nav-item">{!! link_to_route('signup.get', 'アカウント作成', [], ['class' => 'nav-link text-dark']) !!}</li>-->
                    <!--{{-- ログインページへのリンク --}}-->
                    <!--<li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>-->
                    <!--{{-- ログインページへのリンク --}}-->
        <!--            {!! link_to_route('top', 'Topページ', [], ['class' => 'navbar-brand text-primary']) !!}-->
        <!--            {{-- 作品投稿へのリンク --}}-->
        <!--            <li class="nav-item">{!! link_to_route('works.create', '作品を投稿', [], ['class' => 'nav-link text-success']) !!}</li>-->
                    
                    
        <!--        @endif-->
        <!--    </ul>-->
        <!--</div>-->
    </nav>
</header>
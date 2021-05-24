
<header class="mb-4">
    <nav class="navbar navbar-light bg-white border border-bottom">
        
        <div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- トップページへのリンク --}}
            <a class="navbar-brand text-primary text-left " href="/">Original</a>
        </div>
        <div class="col-3 d-flex align-items-center rounded-pill shadow-sm" >
            <i class="fas fa-search mr-1"></i>
            <input type="text" class="search form-control border-0" size="10" placeholder="作品を検索">
        </div>
       
       <div class="float-right d-none d-sm-block mr-5">
           <button class="mr-2 btn btn-secondary" type="submit">作品を投稿</button>
            
            <div class="dropdown d-inline-block mr-5">
                <i class="fas fa-portrait fa-2x align-middle"></i>
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"></button>
                <!-- 選択肢 -->
                <div class="dropdown-menu">
                    
                    @if (Auth::check())
                       {{-- ユーザ詳細ページへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('users.show', Auth::user()->name, ['user' => Auth::id()]) !!}</li>
                        
                        <li class="dropdown-divider"></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        
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
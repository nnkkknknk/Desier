<header class="mb-4">
    <nav class="navbar navbar-light navbar-expand-md bg-white border border-bottom row mr-0">
        
        <div class="col-3 col-sm-4">
             {!! link_to_route('top', 'Desier', [], ['class' => 'navbar-brand text-primary']) !!}
        </div>
        <div class="col-5 col-sm-4">
            {!! Form::open(['route' => 'work.search', 'method' => 'post'], ['class' => 'bg-secondary']) !!}
            <div class="d-flex align-items-center rounded-pill shadow-sm pr-4" >
               
                 <i class="fas fa-search ml-3"></i>
                    {!! Form::text('keyword', null, ['class' => 'form-control border-0','placeholder'=>"検索"]) !!}
            </div>
            {!! Form::close() !!}
        </div>
        
            <div class="dropdown col-4 text-right">
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
                    
                </div>
            </div>
    </nav>
</header>
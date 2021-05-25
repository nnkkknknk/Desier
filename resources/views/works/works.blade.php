@if (count($works) > 0)
    <ul class="list-unstyled">
        @foreach ($works as $work)
            <li class="media mb-3">
                <!--{{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}-->
                <!--<img class="mr-2 rounded" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">-->
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $work->user->name, ['user' => $work->user->id]) !!}
                        <span class="text-muted">posted at {{ $work->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($work->content)) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $works->links() }}
@endif
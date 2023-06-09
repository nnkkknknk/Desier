@if (Auth::check())
    @if (Auth::id() != $user->id)
        @if (Auth::user()->is_following($user->id))
            {{-- アンフォローボタンのフォーム --}}
            {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete','class' => "col-12 d-flex justify-content-center"]) !!}
                {!! Form::submit('フォロー解除', ['class' => "btn btn-danger btn-block"]) !!}
            {!! Form::close() !!}
        @else
            {{-- フォローボタンのフォーム --}}
            {!! Form::open(['route' => ['user.follow', $user->id],'class' => "col-12 d-flex justify-content-center"]) !!}
                {!! Form::submit('フォロー', ['class' => "btn btn-primary btn-block rounded-pill"]) !!}
            {!! Form::close() !!}
        @endif
    @endif
@endif
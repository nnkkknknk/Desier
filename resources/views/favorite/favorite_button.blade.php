@if (Auth::check())
    @if (Auth::id() != $work->user_id)
        @if (Auth::user()->is_favoriting($work->id))
            {{-- アンフォローボタンのフォーム --}}
            {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete' ,'class' => "col-12"]) !!}
                {!! Form::submit('お気に入り解除', ['class' => "btn btn-danger col-4 col-lg-2"]) !!}
            {!! Form::close() !!}
        @else
            {{-- お気に入りボタンのフォーム --}}
            {!! Form::open(['route' => ['favorites.favorite', $work->id] ,'class' => "col-12"]) !!}
                {!! Form::submit('お気に入り☆', ['class' => "btn bg-warning rounded-pill col-3 col-lg-2"]) !!}
            {!! Form::close() !!}
        @endif
    @else 
    
            {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete','class' => "col-12"]) !!}
                {!! Form::submit('削除', ['class' => "btn btn-danger col-4 col-lg-2"]) !!}
            {!! Form::close() !!}
    @endif
@endif
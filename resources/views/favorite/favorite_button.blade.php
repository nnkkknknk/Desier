@if (Auth::id() != $work->user_id)
    @if (Auth::user()->is_favoriting($work->id))
        {{-- アンフォローボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger  col-2"]) !!}
        {!! Form::close() !!}
    @else
        {{-- お気に入りボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $work->id]]) !!}
            {!! Form::submit('お気に入り☆', ['class' => "btn g-warning rounded-pill col-2"]) !!}
        {!! Form::close() !!}
    @endif
@else 

        {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => "btn btn-danger  col-2"]) !!}
        {!! Form::close() !!}
@endif
@if (Auth::id() != $work->user_id)
    @if (Auth::user()->is_favoriting($work->id))
        {{-- アンフォローボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger  col-2"]) !!}
        {!! Form::close() !!}
    @else
        {{-- フォローボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $work->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary  col-2"]) !!}
        {!! Form::close() !!}
    @endif
@else 

        {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
            {!! Form::submit('delete', ['class' => "btn btn-danger  col-2"]) !!}
        {!! Form::close() !!}
@endif
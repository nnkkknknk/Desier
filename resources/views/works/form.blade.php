{!! Form::open(['route' => 'works.store']) !!}
    <div class="form-group">
        {!! Form::textarea('title', null, ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}
@extends('layouts.app')

@section('content')
   <h1>
       投稿ページ
   </h1>
   
   <div class="row">
        <div class="col-6">
            {!! Form::model($work, ['route' => 'works.store']) !!}

                <div class="form-group">
                    {!! Form::label('title', '作品名') !!}
                    {!! Form::text('title', '無題', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
   
   
@endsection
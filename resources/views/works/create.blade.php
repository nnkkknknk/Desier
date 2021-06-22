@extends('layouts.app')

@section('content')
   <h1>
       投稿ページ
   </h1>
   
   <div class="row">
        <div class="col-12">
            
            <!--include('upload.upload_image')-->
            
            {!! Form::model($work, ['route' => 'works.store', 'files' => true]) !!}

                <div class="form-group">
                    <p>{!! Form::label('upload_image[]', '画像') !!}</p>
                    <p>{!! Form::file('upload_image[]', ['class'=>'form-controll' ,'multiple' => 'multiple' ]) !!}</p>
                    <p>{!! Form::label('code[]', 'コードファイル') !!}</p>
                    <p>{!! Form::file('code[]', ['class'=>'form-controll' ,'multiple' => 'multiple' ]) !!}</p>
                    {!! Form::label('title', '作品名') !!}
                    {!! Form::text('title', '無題', ['class' => 'form-control']) !!}
                    {!! Form::label('description', '作者からの一言') !!}
                    {!! Form::textarea('description', '作者からの一言', ['class' => 'form-control']) !!}
                    {!! Form::label('tag', '#タグ') !!}
                    {!! Form::text('tag', '#タグ', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
   
   
@endsection
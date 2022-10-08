@extends('layouts.app')

@section('content')
<script src="{{ asset('js/img_view.js') }}"></script>
<div class="bg-white">
    
</div>
   <div class="row d-flex align-items-center justify-content-center">
       <h3 class="bg-white  col-5 col-lg-3 shadow-sm py-3 my-5 rounded-pill text-center">
        作品を投稿
    </h3>
   </div>
   
   <div class="row bg-white  py-3">
        <div class="col-12">
            
            <!--include('works.confirm')-->
            

<!--<input type="file" onchange="OnFileSelect( this );" multiple />-->
<!--<ul id="ID001">-->
    <!--<img src='fileReader.result'>-->
<!--</ul>-->

            {!! Form::model($work, ['route' => 'works.store', 'files' => true]) !!}

                <div class="form-group">
                    <div>{!! Form::label('upload_image[]', '画像') !!}</div>
                    <div class="mb-3">{!! Form::file('upload_image[]', ['class'=>'form-controll' ,'multiple' => 'multiple' ]) !!}</div>
                    <div>{!! Form::label('code[]', 'コードファイル') !!}</div>
                    <div class="mb-3">{!! Form::file('code[]', ['class'=>'form-controll' ,'multiple' => 'multiple' ]) !!}</div>
                    {!! Form::label('title', '作品名') !!}
                    {!! Form::text('title', '無題', ['class' => 'form-control mb-3']) !!}
                    {!! Form::label('description', '作品説明') !!}
                    {!! Form::textarea('description', '作品説明', ['class' => 'form-control mb-3']) !!}
                    {!! Form::label('tag', '#タグ') !!}
                    {!! Form::text('tag', '#タグ', ['class' => 'form-control mb-3']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
                    
                </div>

            {!! Form::close() !!}
        </div>
    </div>
  
   
@endsection
@extends('layouts.app')

@section('content')
    <!--@php-->
    <!--    dd($user->self_information);-->
    <!--@endphp-->
    <h1>
       プロフィール編集
   </h1>
   
   <div class="row">
        <div class="col-12">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'files' => true, 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                    {!! Form::label('self_information', '自己紹介') !!}
                    {!! Form::textarea('self_information', '自己紹介(225文字以内)', ['class' => 'form-control']) !!}
                    <p>{!! Form::label('icon', 'アイコン画像') !!}</p>
                    {!! Form::file('icon', ['class'=>'form-controll']) !!}
                </div>
                {!! Form::submit('プロフィールを更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
            
            
        </div>
    </div>
    
    
@endsection
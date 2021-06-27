@extends('layouts.app')

@section('content')
    <!--@php-->
    <!--    dd($user->self_information);-->
    <!--@endphp-->
    <h3 class="offset-3 offset-lg-4 col-6 col-lg-4 shadow-sm py-3 my-5 rounded-pill text-center">
    プロフィール編集
    </h3>
   
   <div class="row bg-white py-3">
        <div class="col-12">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'files' => true, 'method' => 'put']) !!}
                <div class="form-group">
                    <div>{!! Form::label('name', '名前') !!}</div>
                    <div class="mb-3">{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}</div>
                    <div>{!! Form::label('self_information', '自己紹介') !!}</div>
                    <div class="mb-3">{!! Form::textarea('self_information', '', ['class' => 'form-control']) !!}</div>
                    <div>{!! Form::label('icon', 'アイコン画像') !!}</div>
                    <div class="mb-3">{!! Form::file('icon', ['class'=>'form-controll']) !!}</div>
                </div>
                <div class="text-center">{!! Form::submit('プロフィールを更新', ['class' => 'btn btn-primary']) !!}</div>

            {!! Form::close() !!}
            
            
        </div>
    </div>
    
    
@endsection
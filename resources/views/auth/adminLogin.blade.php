@extends('layouts.app')

@section('content')
<div class="bg-white">
    
    <div class="text-center mt-5 py-3">
        <h1 class="text-primary">管理者ログイン</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3 bg-white">

            {!! Form::open(['route' => 'adminlogin.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
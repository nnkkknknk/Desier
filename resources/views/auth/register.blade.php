@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="text-center mt-5 py-3">
        <h1 class="text-primary">Desier</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('アカウント作成', ['class' => 'btn btn-primary btn-block
                my-5']) !!}
            {!! Form::close() !!}
            
            <p class="mt-2">ログインされる方は {!! link_to_route('login', 'こちらへ') !!}</p>
        </div>
        </div>
    </div>
</div>
@endsection
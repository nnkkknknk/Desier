@extends('layouts.app')

@section('content')
<div class="bg-white mx-5 mb-5">
    <div class="text-center mt-5 py-3">
        <h1 class="text-primary">Desier</h1>
    </div>

    <div class="row">
        <div class="col-8 offset-2 col-md-6 offset-md-3 ">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group bg-white">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group bg-white">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group bg-white">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group bg-white">
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
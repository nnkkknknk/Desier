@extends('layouts.app')

@section('content')
<div class="bg-white mx-5 mb-5">
    
    <div class="text-center mt-5 py-3">
        <h1 class="text-primary">Desier</h1>
    </div>

    <div class="row">
        <div class="col-8 offset-2 col-md-6 offset-md-3">

            {!! Form::open(['route' => 'login.post']) !!}
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

            {{-- ユーザ登録ページへのリンク --}}
            <p class="mt-2">新規ユーザーの方は {!! link_to_route('signup.get', 'こちらへ') !!}</p>
        </div>
    </div>
</div>
@endsection
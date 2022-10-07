@extends('layouts.app')

@section('content')

<div class="bg-white">
    <ul>
            <li>
                ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}
            </li>
            <li>
                <a href="{{ route('admin.logout') }}">
                    ログアウト
                </a>
            </li>
        </ul>
    
</div>
@endsection
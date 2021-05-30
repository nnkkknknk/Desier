@extends('layouts.app')

@section('content')

    <h1>id = {{ $work->id }} のメッセージ詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $work->id }}</td>
        </tr>
        <tr>
            <th>メッセ</th>
            <td>{{ $work->title }}</td>
        </tr>
    </table>

@endsection
@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像アップロード - 確認画面</h1>
    <div class="container mb-5">
        <div class="form-group row">
                <p class="col-sm-4 col-form-label">画像</p>
                <div class="col-sm-8">
                    <!--@php-->
                    <!--    dd($image);-->
                    <!--@endphp-->
                    
                    @if(count($images) > 0)
                    @php
                     $image_num = count($images);
                    @endphp
                    @foreach ($images as $image)
                        <img src="{{$image}}" alt="", style="width:100%;"/>
                        <input type="hidden" name="image" value="{{ $newImageName }}">
                    @endforeach
                    
                    @else
                    @endif
                </div>
        </div>
       
    </div>
@endsection
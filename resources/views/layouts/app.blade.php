<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Desier</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/allshowbtn.css') }}">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <style>
            html {overflow-y: scroll;}
            #body {
                background-color: rgb(180, 230, 230);
                min-height: 100vh;
                position: relative; /*←相対位置*/
                padding-bottom: 100px;/*←footerの高さ*/
                box-sizing: border-box;/*←全て含めてmin-height:100vhに*/
            }
        </style>
    </head>
    
    <body id="body" class='pb-5'>
   
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
            
        </div>
        
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        @include('commons.footer')
    </body>
</html>
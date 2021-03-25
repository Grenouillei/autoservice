<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <title>AUTIO</title>
    </head>
    <body>

        <div class="welcome" >
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home_page') }}">{{ Auth::user()->name }}</a>
                @else
                    <a href="{{ route('login') }}" class="in">Вхід</a><a> / </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="out">Реєстрація</a>
                    @endif
                @endauth
            @endif
        </div>

        <div class="welcome_img">
            <img src="img/Logo2.svg" alt="">
        </div>

        <div class="welcome_img2">
            <img src="img/twitter.svg" width="30px" height="30px" alt="">
            <img src="img/inst.svg" width="30px" height="30px" alt="">
            <img src="img/faceb.svg" width="30px" height="30px" alt="">

        </div>
      <!--<img src="img/mainphoto2.jpg" alt="" width="100%" height="100%" style="">-->


    </body>
</html>

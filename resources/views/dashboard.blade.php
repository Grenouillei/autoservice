<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="64x64" href="img/Minilogo.svg">
    <link rel="stylesheet" href="{{ asset("css/contact.css") }}">
    <link rel="stylesheet" href="{{ asset("css/home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/new.css") }}">
    <link rel="stylesheet" href="{{ asset("css/search.css") }}">
    <link rel="stylesheet" href="{{ asset("css/basket.css") }}">
    <link rel="stylesheet" href="{{ asset("css/brands.css") }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/archive.css') }}">

    <!--<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <title>AUTIO</title>
</head>
<body>


<div class="header">

    <div class="search">
        <form action="{{route('page.search')}}" method="GET">
            <div class="search_content">
                <input type="text" name="search_text"  value="" placeholder="  Пошук">
            </div>
            <div class="search_button"><button>Знайти</button></div>
        </form>
    </div>



    <img src="{{asset('img/Logo2.svg')}}" alt="" style="float: left; position: absolute; width: 100px; height: 100px; margin-left: 50px">

    <div class="container_menu">
        <div class="main_menu">
            <a href="{{route('page.home')}}">Головна</a>
            <a href="{{route('page.about')}}">Про нас</a>
            <a href="{{route('page.contact')}}">Контакти</a>
            <a href="">Більше</a>
        </div>
    </div>

    <div class="basket_block">
        <p></p>
        <a href="{{route('page.basket')}}">Кошик
            <b style="color: dodgerblue;">
                {{$res}}
            </b>
        </a>
    </div>


    <div class="reg_menu" style="margin-right: 110px;">
        <form method="POST" action="{{ route('logout') }}">
            <a class="reg_name" href="{{route('page.user')}}" @if(auth()->user()->premium)style="color: orange" @endif>
                {{auth()->user()->name}}
            </a>
            <a>/</a>
            @csrf
            <a class="reg_log" :href="route('logout')"
                                   onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Вихід') }}
            </a>
        </form>
    </div>
</div>
    @yield('main_content')

    @include('footer')
</body>
</html>


@extends('dashboard')

@section('main_content')
    <div id="about_block">
        <div class="about_about">
            <img src="{{asset('img/Logo2.svg')}}" alt="" style="float: left; width: 200px; height: 200px; margin-left: 60px">
            <div class="about_text">
                <p> -  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            </div>
        </div>

        <div class="about_img1"><h1 class="mark1">MUSTANG</h1><img src="{{asset('img/about.png')}}" style="" alt=""></div>
        <div class="about_img2"><h1 class="mark2" >BMW</h1><img src="{{asset('img/about2.png')}}" style="" alt=""></div>
        <div class="about_img3"><h1 class="mark3" >AUDI</h1><img src="{{asset('img/about3.png')}}" style="" alt=""></div>

        <div class="about_progress">
            <p>
                Ми захоплені наданням послуг вам.
                Наша мета - надати правильні послуги з розвитку бізнесу у відповідний час,
                щоб компанії могли скористатися створеним імпульсом та процвітати протягом тривалого періоду часу
                Все, що ми рекомендуємо, має прямий позитивний вплив
                Ви станете важливим партнером нашої компанії</p>

            <h2 style="margin-top: 90px; text-align: center;color: white;margin-left: 0;">За останній місяць: </h2>
            <h2 class="number1"></h2>
            <h2 class="number2">2</h2>
            <h2 class="number3">3</h2>
        </div>

        <script>
            $(document).ready(function () {
                $('.number1').animate({ num: 90.78 - 3/* - начало */ }, {
                    duration: 3000,
                    step: function (num){
                        this.innerHTML = (num + 3).toFixed(2) + '% - Задоволених відгуків'
                    }
                });
                $('.number2').animate({ num: 1460 - 3/* - начало */ }, {
                    duration: 3000,
                    step: function (num){
                        this.innerHTML = (num + 3).toFixed(0) + ' - Продано товару'
                    }
                });
                $('.number3').animate({ num: 73.23 - 3/* - начало */ }, {
                    duration: 3000,
                    step: function (num){
                        this.innerHTML = (num + 3).toFixed(2) + '% - ще якась діч'
                    }
                });
            });
        </script>
    </div>
@endsection

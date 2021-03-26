@extends('dashboard')

@section('main_content')
    <div class="buy_content">
        <h1 style="text-align: center; padding-top: 2%;">Підтвердження замовлення</h1>
        <div class="buy_left">
            <form action="" method="post" >
                @csrf
                <h2>Ваші контактні дані :</h2>
                <label for="name" class="label">Ім'я</label><br>
                <input class="input" type="text" name="name" @error('name')style="border: 1px solid orangered"@enderror placeholder=" Ім'я"><br><br>
                <label for="email" class="label">Прізвище</label><br>
                <input class="input" type="email" name="email" @error('email')style="border: 1px solid orangered"@enderror placeholder=" Прізвище"><br><br>
                <label for="password" class="label">Мобільний телефон</label><br>
                <input class="input" type="password" name="password" @error('password')style="border: 1px solid orangered"@enderror placeholder=" +(380)..."><br><br>
                <label for="confirm_password" class="label">Місто</label><br>
                <input class="input" type="password" name="confirm_password" @error('password')style="border: 1px solid orangered"@enderror placeholder=" Місто"><br><br>

                <h2>Доставка :</h2>
                    <div class="pay_delivery">
                        <iframe class="buy_maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d748.3932362768304!2d2.039359329232355!3d41.38336219870404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49a4cd37cf46b%3A0xb2c3185a578ef5be!2zUGxhw6dhIGRlIEZhbGd1ZXJhLCAwODk4MCBTYW50IEZlbGl1IGRlIExsb2JyZWdhdCwgQmFyY2Vsb25hLCDQmNGB0L_QsNC90LjRjw!5e0!3m2!1sru!2sua!4v1616593250357!5m2!1sru!2sua" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                <h2>Оплата :</h2>
                    <div class="pay_block">
                        <input type="radio" name="id" id="name1" class="buy_radio">
                        <label for="name1" class="label2"><b>Оплата при отриманні товару</b>
                        <p style="margin-top: 10px; margin-left: 40px;">(Послуга післяплати оплачується окремо, за тарифами перевізника)</p></label><br><br>
                    </div>
                    <div class="pay_block" style="height: 40px;">
                        <input type="radio" name="id" id="name2" class="buy_radio">
                        <label for="name2" class="label2"><b>Оплата карткою</b> Visa/MasterCard (LiqPay)</label><br><br>
                    </div>
                    <div class="pay_block">
                        <input type="radio" name="id" id="name3" class="buy_radio">
                        <label for="name3" class="label2">Кредит та оплата частинами
                            Оформлення кредитів у банках партнерів</label><br><br>
                    </div>
            </form>
            <a href="{{route('basket')}}"><button type="submit" class="buy_button_back">Назад</button></a>
            <button type="submit" class="buy_button_confirm">Підтвердити</button>
        </div>
        <div class="buy_right">

        </div>
    </div>
@endsection

@extends('dashboard')

@section('main_content')
    <div class="premium_content">
        <h1>Покупка <b style="color: orange">Premium</b>-акаунту</h1>

            <div class="premium_info">
                <p style="font-weight: bold;margin-left: 140px;">Що вам це дає?</p>
                <p>1. Естетитка - ваш нік-нейм підсвічується помаранчевим кольором!</p>
                <p>2. Ви отримуєте скидку в розмірі 10% на певні бренди!</p>
                <p>3. Доставка товару безкоштовна!</p>
                <p>4. Advantages</p>
            </div>

            <div class="premium_buy">
                <div class="premium_card">
                    <input type="radio" name="id" id="name1" class="buy_radio" checked>
                    <label for="name1" class="label3" style="margin-left: -3px;"><b>Visa</b></label>
                    <input type="radio" name="id" id="name2" class="buy_radio" style="margin-left: 20px;">
                    <label for="name2" class="label3" style="margin-left: -3px;"><b>Master Card</b></label><br>
                </div><br>

                <label for="email" class="label">Email</label><br>
                <input class="input" type="text" name="email" @error('email')style="border: 1px solid orangered"@enderror placeholder=" Email"><br><br>
                <label for="name" class="label">Ім'я</label><br>
                <input class="input" type="text" name="name" @error('name')style="border: 1px solid orangered"@enderror placeholder=" Ім'я"><br><br>
                <label for="lastName" class="label">Прізвище</label><br>
                <input class="input" type="text" name="lastName" @error('lastName')style="border: 1px solid orangered"@enderror placeholder=" Прізвище"><br><br>
                <label for="card" class="label">Картка</label><br>
                <input class="input" type="text" name="card" @error('card')style="border: 1px solid orangered"@enderror placeholder=" XXXX XXXX XXXX XXXX"><br><br>
                <label for="date" class="label">Термін</label><br>
                <input class="input_sm" type="text" name="date" @error('date')style="border: 1px solid orangered"@enderror placeholder=" Date">
                <input class="input_sm" style="margin-left: 25px;" type="text" name="cvv" @error('cvv')style="border: 1px solid orangered"@enderror placeholder=" CVV"><br><br>

                <form action="{{route('user.premium')}}" method="get">
                    <button class="premium_confirm">Купити</button>
                </form>
            </div>

        <a href="{{route('page.user')}}" style="margin-left: 50px;">< Back</a>
    </div>
@endsection

@extends('dashboard')

@section('main_content')
    <div class="buy_content">
        <h1 style="text-align: center; padding-top: 3%;padding-bottom: 2%">Підтвердження замовлення</h1>
        <div class="buy_left">
            <form action="{{route('confirm_order')}}" method="post" >
                @csrf
                <h2>Ваші контактні дані :</h2>
                <label for="name" class="label">Ім'я</label><br>
                <input class="input" type="text" name="name" @error('name')style="border: 1px solid orangered"@enderror placeholder=" Ім'я"><br><br>
                <label for="lastName" class="label">Прізвище</label><br>
                <input class="input" type="text" name="lastName" @error('lastName')style="border: 1px solid orangered"@enderror placeholder=" Прізвище"><br><br>
                <label for="phone" class="label">Мобільний телефон</label><br>
                <input class="input" type="text" name="phone" @error('phone')style="border: 1px solid orangered"@enderror placeholder=" +(380)..."><br><br>
                <label for="city" class="label">Місто</label><br>
                <input class="input" type="text" name="city" @error('city')style="border: 1px solid orangered"@enderror placeholder=" Місто"><br><br>
                <input class="mass_id" type="hidden" name="id_array" value=""/>
                <input class="mass_qty" type="hidden" name="qty_array" value=""/>
                <input class="mass_sum" type="hidden" name="sum_array" value=""/>
                <h2>Доставка :</h2>
                    <div class="pay_delivery">
                        <iframe class="buy_maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d748.3932362768304!2d2.039359329232355!3d41.38336219870404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49a4cd37cf46b%3A0xb2c3185a578ef5be!2zUGxhw6dhIGRlIEZhbGd1ZXJhLCAwODk4MCBTYW50IEZlbGl1IGRlIExsb2JyZWdhdCwgQmFyY2Vsb25hLCDQmNGB0L_QsNC90LjRjw!5e0!3m2!1sru!2sua!4v1616593250357!5m2!1sru!2sua" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                <h2>Оплата :</h2>
                    <div class="pay_block">
                        <input type="radio" name="id" id="name1" class="buy_radio" checked>
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
                <button type="" class="buy_button_confirm">Замовити</button>
            </form>
            <a href="{{route('basket')}}"><button type="submit" class="buy_button_back">Назад</button></a>
        </div>
        <div class="buy_right">
            <h2 style="color: white;margin-left: 20px;">Список покупок :</h2>
            <script>
                let arr_qty = [];
                let arr_id = [];
            </script>
            @foreach($products as $product)
                @if($product->id_user==auth()->user()->id)
                    <div class="product_block">
                        <div class="product_name"><p >{{$product->getGoods()[0]['name']}}</p></div>
                        <div class="product_price"><p >
                                @if(!auth()->user()->premium){{$product->getGoods()[0]['price']}}
                                @else{{$product->getGoods()[0]['price']-$product->getGoods()[0]['price']*0.1 }}
                                @endif x <a class="{{$product->id}}" id="quantity"></a> шт.</p></div>
                        <div class="product_res"><p class="result{{$product->getGoods()[0]['id']}}"></p></div>
                    </div>

                    <script>
                        var res{{$product->id}} = window.localStorage.getItem("value{{$product->id}}");
                        if(res{{$product->id}}!=null)
                            $('.{{$product->id}}').html(res{{$product->id}});
                        else
                            $('.{{$product->id}}').html('1');

                        qty = $('.{{$product->id}}').text();
                        qtyx = Number(qty);
                        @if(!auth()->user()->premium)
                            price = {{$product->getGoods()[0]['price']}};
                        @else
                            price = {{$product->getGoods()[0]['price']-$product->getGoods()[0]['price']*0.1 }};
                        @endif
                        pricex = Number(price);

                        arr_qty.push(qtyx);
                        arr_id.push({{$product->getGoods()[0]['id']}});

                        result = pricex*qtyx;
                        $('.result{{$product->getGoods()[0]['id']}}').append(result.toFixed(2) + ' грн');
                    </script>
                @endif
            @endforeach
            <script>
                $(document).ready(function () {
                    $('.total').append('Сума : '+ window.localStorage.getItem("total") + ' грн');
                    $('.mass_id').val(arr_id);
                    $('.mass_qty').val(arr_qty);
                    $('.mass_sum').val(window.localStorage.getItem("total"));
                });
            </script>
            <h2 class="total" style="color: white;float: right;margin-right: 20px;"></h2>
        </div>
    </div>
@endsection

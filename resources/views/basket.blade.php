@extends('dashboard')

@section('main_content')
    @if(!$empty)<div style="height: 460px"> <h1 style="text-align: center;">Ваш кошик порожній!</h1></div> @endif
    @if($empty)
    <DIV class="summa_basket">
        <p id="total" style="font-size: 40px;position: absolute;margin-top: 50px; font-weight: bold; color: white;">
            СУММА:
        </p>
        <div id="buy_confirm">
            <a href="{{route('buy')}}"><button>
                ОФОРМИТИ ЗАМОВЛЕННЯ
            </button></a>
        </div>
    </DIV>
    <div class="out_basket">
        <div class="out_foto"><h1>ФОТО</h1></div>
        <div class="out_name"><h1>НАЗВА</h1></div>
        <div class="out_qty"><h1>КІЛ-CТЬ</h1></div>
        <div class="out_price"><h1>ЦІНА</h1></div>
        <div class="out_brand"><h1>БРЕНД</h1></div>
        <div class="out_code"><h1>КОД</h1></div>
        <div class="out_act"><h1>ДІЇ</h1></div>
    </div>
    <div id="content_block_basket">
        @foreach($product as $element)
            @if($element->id_user==auth()->user()->id)
            <div class="content_item_basket">
                <div class="content_image_basket">
                    @if($element->id%2==0)
                    <img src="img\details.jpg" width="140" height="140" alt="" style="opacity: 70%">
                    @endif
                        @if($element->id%2>=1)
                            <img src="img\details2.jpg" width="140" height="140" alt="" style="opacity: 70%">
                        @endif
                </div>
                 <div class="content_name_basket">
                     <p>{{$element->getGoods()[0]['name']}}</p>
                 </div>
                <div class="content_char1_basket">
                    <p class="{{$element->id}}" id="quantity">1</p>
                        <button id="{{$element->id}}" class="minus">-</button>
                                штук
                        <button id="{{$element->id}}" class="plus">+</button>
                </div>
                <div class="content_char_basket">
                   @if(!auth()->user()->premium) <p>{{$element->getGoods()[0]['price']}} ₴</p>@endif
                    @if(auth()->user()->premium)<p style="color: lime">{{$element->getGoods()[0]['price']-$element->getGoods()[0]['price']*0.1 }}₴</p>@endif
                    грн / шт.
                </div>
                <div class="content_char1_basket">
                    <p>{{$element->getGoods()[0]['brand']}}</p>
                </div>
                <div class="content_char_basket">
                    <p>{{$element->getGoods()[0]['code']}}</p>
                </div>
                <div class="content_navigation_basket">
                    <form action="/del" method="GET">
                        <input type="hidden" name="id" value="{{$element->id}}"/>
                        <button class="button_delete">ВИДАЛИТИ</button>
                    </form>
                    <form action="{{route('new')}}" method="GET">
                        <input type="hidden" name="id" value="{{$element->id_good}}"/>
                        <button class="button_more">БІЛЬШЕ</button>
                    </form>
                </div>
            </div>
            <br>
                <script>
                    var res{{$element->id}} = window.localStorage.getItem("value{{$element->id}}");
                        if(res{{$element->id}}!=null)
                            $('.{{$element->id}}').html(res{{$element->id}});
                        else
                            $('.{{$element->id}}').html('1');
                </script>
            @endif
        @endforeach
            <script>
                $(".plus").click(function() {
                    var clickId = $(this).attr('id');
                    var temp = $('.'+clickId+'').text();
                    var res = Number(temp);
                    res = res + 1;
                        if (res>=10){
                            res = 10;
                        }
                    $('.'+clickId+'').html('');
                    $('.'+clickId+'').append(res);
                    window.localStorage.setItem('value'+clickId+'', res);
                    getTotal();
                });

                $(".minus").click(function() {
                    var clickId = $(this).attr('id');
                    var temp = $('.'+clickId+'').text();
                    var res = Number(temp);
                    res = res - 1;
                         if (res<=1){
                             res = 1;
                         }
                    $('.'+clickId+'').html('');
                    $('.'+clickId+'').append(res);
                    window.localStorage.setItem('value'+clickId+'', res);
                    getTotal();
                });

               function getTotal(){
                   let arr = [];
                   let id = [];
                   let qty = [];
                   var temp = 0;
                   var tempx = 0;
                   @foreach($product as $element)
                       @if($element->id_user==auth()->user()->id)
                            temp = $('.{{$element->id}}').text();
                            tempx = Number(temp);
                            qty.push(tempx);
                            id.push({{$element->id}});
                            @if(!auth()->user()->premium)arr.push({{$element->getGoods()[0]['price']}});@endif
                            @if(auth()->user()->premium)arr.push({{$element->getGoods()[0]['price']-$element->getGoods()[0]['price']*0.1}});@endif
                        @endif
                   @endforeach
                   var score = 0;
                   var sum = 0;
                   if (arr.length > 0) {
                       for (let i = 0; i < arr.length; i++) {
                           sum = sum + Number(arr[i]) * Number(qty[i]);
                           score = score + 1;
                       }
                   }
                   if (score<=1){
                       $("#content_block_basket").css("margin-bottom", "300px");
                   }
                       $('#total').html('Сума замовлення: ');
                       $('#total').append(sum.toFixed(2) + ' грн');
               }

               $(document).ready(function () {
                   getTotal();
               });
        </script>
    </div>
    @endif
@endsection

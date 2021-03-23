@extends('dashboard')

@section('main_content')
    @if(!$empty)<div style="height: 460px"> <h1 style="text-align: center;">ВАШ КОШИК ПОРОЖНІЙ!</h1></div> @endif
    @if($empty)
    <DIV class="summa_basket">
        <p id="total" style="font-size: 40px;position: absolute;margin-top: 50px; font-weight: bold; color: white;">
            СУММА:
        </p>
        <div id="buy_confirm">
            <button>
                ОФОРМИТИ ЗАМОВЛЕННЯ
            </button>
        </div>
    </DIV>
    <div class="out_basket">
        <div class="out_foto"><h1>ФОТО</h1></div>
        <div class="out_name"><h1>НАЗВА</h1></div>
        <div class="out_qty"><h1>КІЛ-CТЬ</h1></div>
        <div class="out_price"><h1>ЦІНА</h1></div>
        <div class="out_brand"><h1>БРЕНД</h1></div>
        <div class="out_code"><h1>КОД</h1></div>
    </div>
    <div id="content_block_basket">
        @foreach($product as $element)
            @if($element->user_id==\Illuminate\Support\Facades\Auth::user()->id)
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
                     <p>{{$element->name}}</p>
                 </div>
                <div class="content_char1_basket">
                    <p class="quantity{{$element->id}}">1</p>
                        <button id="minus{{$element->id}}" class="minus">-</button>
                                штук
                        <button id="plus{{$element->id}}" class="plus">+</button>
                </div>
                <div class="content_char_basket">
                   @if(!$user_premium) <p>{{$element->price}}₴</p>@endif
                    @if($user_premium)<p style="color: lime">{{$element->price-$element->price*0.1 }}₴</p>@endif
                    грн / шт.
                </div>
                <div class="content_char1_basket">
                    <p>{{$element->brand}}</p>
                </div>
                <div class="content_char_basket">
                    <p>{{$element->code}}</p>
                </div>
                <div class="content_navigation_basket">
                    <form action="/del" method="GET">
                        <input type="hidden" name="id" value="{{$element->id_s}}"/>
                        <button class="button_delete">ВИДАЛИТИ</button>
                    </form>
                    <form action="{{route('new')}}" method="GET">
                        <input type="hidden" name="id" value="{{$element->id_s}}"/>
                        <button class="button_more">БІЛЬШЕ</button>
                    </form>
                </div>
            </div>
            <br>
                <script>
                    var res{{$element->id}} = window.localStorage.getItem("value{{$element->id}}");
                    $('.quantity{{$element->id}}').html(res{{$element->id}});
                    //console.log('res{{$element->id}} = '+res{{$element->id}});

                        $("#plus{{$element->id}}").click(function(){
                            var temp = $('.quantity{{$element->id}}').text();
                            res{{$element->id}} = Number(temp);
                            res{{$element->id}} = res{{$element->id}} + 1;
                                if (res{{$element->id}}>=10) {
                                    res{{$element->id}}=10;
                                }
                            //console.log(res{{$element->id}});
                            $('.quantity{{$element->id}}').html('');
                            $('.quantity{{$element->id}}').append(res{{$element->id}});
                            window.localStorage.setItem('value{{$element->id}}', res{{$element->id}});
                        });

                        $("#minus{{$element->id}}").click(function(){
                            var temp = $('.quantity{{$element->id}}').text();
                            res{{$element->id}} = Number(temp);
                            res{{$element->id}} = res{{$element->id}} - 1;
                            if (res{{$element->id}}<=1){
                                res{{$element->id}} = 1;
                            }
                            //console.log(res{{$element->id}});
                            $('.quantity{{$element->id}}').html('');
                            $('.quantity{{$element->id}}').append(res{{$element->id}});
                            window.localStorage.setItem('value{{$element->id}}', res{{$element->id}});
                        });
                </script>
            @endif
        @endforeach
            <script>
                setInterval(function(){
                let arr = [];
                let id = [];
                let qty = [];
                var temp = 0; var tempx = 0;

                @foreach($product as $element)
                    @if($element->user_id==\Illuminate\Support\Facades\Auth::user()->id)
                        temp = $('.quantity{{$element->id}}').text();
                        tempx = Number(temp);
                        qty.push(tempx);
                        id.push({{$element->id}});
                        @if(!$user_premium)arr.push({{$element->price}});@endif
                        @if($user_premium)arr.push({{$element->price-$element->price*0.1}});@endif
                    @endif
                @endforeach

            var score=0;
            var sum = 0;
            if(arr.length>0)
            {
                 for(let i=0;i<arr.length;i++) {
                     sum = sum + Number(arr[i])*Number(qty[i]);
                     score=score+1;
                 }
            }
            score=score+1;
            $(document).ready(function() {
                $('#total').html('СУММА: ');
                $('#total').append(sum.toFixed(2)+' грн');
                $("#content_block_basket").css("height", ""+score*130+"px");
            });
            }, 500);
        </script>
    </div>
    @endif
@endsection

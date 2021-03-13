@extends('dashboard')

@section('main_content')
    <DIV class="summa_basket">
        <p id="total" style="font-size: 40px;position: absolute;margin-top: 50px; font-weight: bold">
            СУММА:
        </p>
        <div id="buy_confirm">
            <button >
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
                    <img src="img\details.jpg" width="140" height="140" alt="" style="opacity: 70%">
                </div>
                 <div class="content_name_basket">
                     <p>{{$element->name}}</p>
                 </div>
                <div class="content_char1_basket">
                    <p class="quantity{{$element->id}}">{{$element->qty}}</p>
                        <button id="minus{{$element->id}}">-</button>
                                штук
                        <button id="plus{{$element->id}}">+</button>
                </div>
                <div class="content_char_basket">
                    <p>{{$element->price}}₴</p>
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
                    <form action="new" method="GET">
                        <input type="hidden" name="id" value="{{$element->id_s}}"/>
                        <button class="button_more">БІЛЬШЕ</button>
                    </form>
                </div>
            </div>
            <br>
            <script>
                let arr = [];
                let id = [];
                @foreach($product as $element)
                    @if($element->user_id==\Illuminate\Support\Facades\Auth::user()->id)
                        id.push({{$element->id}});
                        arr.push({{$element->price}});
                    @endif
                @endforeach
            </script>
            @endif
        @endforeach

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            var score=0;
            var sum = 0;
            if(arr.length>0)
            {
                 for(let i=0;i<arr.length;i++) {
                     sum = sum + Number(arr[i]);
                     score=score+1;
                 }
            }
            score=score+1;
            console.log(sum);
            $(document).ready(function() {
                $('#total').append(sum+' грн');
                $('#content_block_basket').css('height',''+score*+'100px');

            });

            for (var i =0;i<=id.length;i++)
            {
                 var temp = $('#minus'+i+'').bind("click", function minus(){
                        console.log('123');
                 });
            }
            function plus(){

            }

        </script>
    </div>
@endsection

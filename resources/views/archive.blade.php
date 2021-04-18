@extends('dashboard')

@section('main_content')
    <div class="archive_content">
        @if(!$empty)<h1 style="text-align: center">Ваш архів порожній!</h1>@endif
        @if($empty)
        <h1 style="margin-left: 60px;padding-top: 30px;">Ваші замовлення :</h1>
        @foreach($orders as $order)
            @if($order->id_user==auth()->user()->id)
            <div class="archive_component" id="archive{{$order->id}}">
                <img class="archive{{$order->id}}" src="{{asset('img/right-arrow2.svg')}}" width="25" height="25" alt="" style="float: right;transform: rotate(90deg);margin-top: 40px;margin-right: 52px;">
                    <div class="archive_slide" id="archive{{$order->id}}"></div>
                    <div class="order_block">
                            <p style="margin-top: 10px;margin-left: 10px;">№ {{rand(100000000,700000000)}} від {{$order->created_at}}</p>
                        <p style="margin-top: 10px;margin-left: 20px;color: limegreen;font-size: 18px;font-weight: bold">Виконано</p>
                    </div>
                    <div class="order_block">
                        <p style="float: right;font-size: 18px;margin-top: 23px;margin-right: 70px;"><a style="font-size: 14px;">Сума : </a><br><b>{{$order->sum_goods}} ₴</b></p>
                    </div>
                <div class="order_block"></div>

                <div class="archive_inner_left">
                    <h3 style="font-size: 20px;"><b>Информація про замовлення : </b></h3>
                        <p>{{$order->name}}</p>
                        <p>{{$order->last_name}}</p>
                        <p>{{$order->city}}</p>
                        <p>{{$order->phone}}</p>
                        <p>{{$order->getUsers()[0]['email']}}</p>
                </div>
                <div class="archive_move">
                    <button class="archive_move_button_1">Повернення</button>
                    <button class="archive_move_button_2">Гарантія</button>
                    <button class="archive_move_button_3">Залишити відгук</button>
                    <button class="archive_move_button_4">Повторити заказ</button>
                </div>
                <div class="archive_inner_right">
                    <br>
                    <p><b>Товари : </b></p><br>
                    @foreach($products as $product)
                        @if($product->id==$order->id)
                            <p>{{$product->name}} <b>|</b> {{$product->price}}₴ x {{$product->qty}} = {{$product->price*$product->qty}}₴</p>
                            <br>
                        @endif
                    @endforeach
                </div>

            </div>
            @endif
        @endforeach
    @endif
    </div>
    <script>
        $(".archive_slide").click(function () {
            var id = $(this).attr('id');
            var height = $('#'+id+'').height();
            if (height==85){
                $('#'+id+'').css("height", "auto");
                $('#'+id+'').css("padding-bottom", "30px");
                $('.'+id+'').css("transform", "rotate(270deg)");
            }
            else{
                $('#'+id+'').css("height", "85");
                $('#'+id+'').css("padding-bottom", "0px");
                $('.'+id+'').css("transform", "rotate(90deg)");
            }
        });
    </script>
@endsection

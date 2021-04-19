@extends('dashboard')

@section('main_content')
    <div id="content_block_brand">
        <div class="content_aside">
            <h1>КАТАЛОГ</h1>

            <p>
                Генератори, Стартера, Підвіска, Гальма, Трансмісія, Двигун, Рульове, Запалювання,
                Опалення і кондиціонування, Підготовка і подання повітря, Паливна симтема, Системи охолодження.
            </p>
            <div style="width: 100%">
                <img src="{{asset('img\detail_1.svg')}}" height="150px" width="150px" style="display: inline-block; margin-left: 8px;" alt="">
                <p style="position: absolute; display: inline-block; width: 200px; margin-top: 50px;">
                    Генератори, Стартера, Підвіска, Гальма, Трансмісія
                </p>
            </div>
            <div style="width: 100%; height: 160px;">
                <p style="position: absolute; display: inline-block; width: 180px; margin-top: 50px;">
                    Двигун, Рульове, Запалювання,
                    Опалення і кондиціонування,
                </p>
                <img src="{{asset('img\detail_2.svg')}}" height="140px" width="140px" style="float: right; margin-right: 8px;" alt="">
            </div>
            <div style="width: 100%;">
                <img src="{{asset('img\detail_3.svg')}}" height="130px" width="130px" style="margin-left: 12px; color: black;" alt="">
                <p style="position: absolute; display: inline-block; width: 200px; margin-top: 40px;">
                    Підготовка і подання повітря, Паливна симтема, Системи охолодження.
                </p>
            </div>

        </div>
        @foreach($parts as $el)
            <div class="content_item_brand" id="id{{$el->id}}">
                        <div class="content_img_brand">
                            <img src="{{asset('img/imagecar1.jpg')}}" width="100%" height="100%" alt="" @if(!$el->able) style=" filter: grayscale(100%);" @endif>
                        </div>
                <div style="height: 15%">
                    <h1 class="content_name_search">{{$el->name}}</h1>
                </div>
                <div class="content_char_search">
                    <div style="width: 150px; float: left; text-align: left; margin-left: 10px;">
                        <p >Бренд : </p>
                        <p >Каталожний номер : </p>
                        <p>Ціна : </p>
                    </div>
                    <div style="width: 110px; float: right; text-align: right; margin-right: 10px;">
                        <p >{{ $el->brand}}</p>
                        <p >{{$el->code}}</p>
                        <p  @if(auth()->user()->premium&&$el->able)style="color: limegreen"@endif>
                            @if(!auth()->user()->premium){{$el->price}} @endif

                            @if(auth()->user()->premium){{$el->price-$el->price*0.1 }} @endif
                            грн </p>
                        <p style="color: red;position: absolute;">@if(auth()->user()->premium&&$el->able)ЗНИЖКА  -10% @endif</p>
                    </div>
                </div>
                <form action="{{route('page.product')}}" method="GET">
                    <!--<input type="hidden" name="brand" value="{{$el->brand}}"/>-->
                    <input type="hidden" name="id" value="{{$el->id}}"/>
                    <button id="{{$el->id}}" class="content_button_search"  @if(!$el->able) style=" background-color: #a0aec0" @endif>Більше</button>
                </form>
            </div>
            @if(!$el->able)
                <style>
                    #id{{$el->id}}:hover{
                        box-shadow: 0 0 3px black;
                        transition: 0.3s;
                    }
                </style>
            @endif
        @endforeach
    </div>
@endsection


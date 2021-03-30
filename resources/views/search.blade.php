@extends('dashboard')

@section('main_content')
    @if(count($array)<1)
            <div style="height: 460px"><h1 style="text-align: center">Нічого не знайдено!</h1></div>
    @else


    <div id="content_block_search">
        <h1 style="text-align: center">Результати пошуку : {{$_GET['search_text']}}</h1>
            <div style="margin-left: 45px;">
    @foreach($array as $ele)
     @foreach($mass as $el)
         @if($el->name==$ele->name)
         <div class="content_item_search">
             <div class="content_inner_search">
                 <img src="img/imagecar1.jpg" width="100%" height="100%" alt="" @if(!$el->able) style=" filter: grayscale(100%);" @endif>
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
                    <p @if($user_premium)style="color: limegreen"@endif>
                        @if(!$user_premium){{$el->price}} @endif
                        @if($user_premium){{$el->price-$el->price*0.1 }} @endif
                        грн </p>
                    <p style="color: red;position: absolute;margin-left: 70px;">@if($user_premium) -10% @endif</p>
                </div>
             </div>
             <form action="{{route('new')}}" method="GET">
                 <input type="hidden" name="brand" value="{{$el->brand}}"/>
                 <input type="hidden" name="id" value="{{$el->id}}"/>
                 <button id="{{$el->id}}" class="content_button_search"  @if(!$el->able) style=" background-color: #a0aec0" @endif >Більше</button>
             </form>

         </div>
         @endif
       @endforeach
    @endforeach
                <button class="next_page">
            <img src="img/right-arrow.svg" width="100px" height="50px" alt="" >
                </button>
            </div>
    </div>
    @endif
   @endsection

@extends('dashboard')

@section('main_content')
    @isset($array)
        <div id="content_block_search">
            <h1 style="text-align: center">Результати пошуку : {{request()->search_text}}</h1>
                <div style="margin-left: 45px;">
        @foreach($array as $ele)
             <div class="content_item_search">
                 <div class="content_inner_search">
                         <img src="img/imagecar1.jpg" width="100%" height="100%" alt="" @if(!$ele->able) style=" filter: grayscale(100%);" @endif>
                 </div>
                 <div style="height: 15%">
                     <h1 class="content_name_search">{{$ele->name}}</h1>
                 </div>
                 <div class="content_char_search">
                    <div style="width: 150px; float: left; text-align: left; margin-left: 10px;">
                        <p >Бренд : </p>
                        <p >Каталожний номер : </p>
                        <p>Ціна : </p>
                    </div>
                    <div style="width: 110px; float: right; text-align: right; margin-right: 10px;">
                        <p >{{ $ele->brand}}</p>
                        <p >{{$ele->code}}</p>
                        <p @if(auth()->user()->premium)style="color: limegreen"@endif>
                            @if(!auth()->user()->premium){{$ele->price}} @endif
                            @if(auth()->user()->premium){{$ele->price-$ele->price*0.1 }} @endif
                            грн </p>
                        <p style="color: red;position: absolute;margin-left: 70px;">@if(auth()->user()->premium) -10% @endif</p>
                    </div>
                 </div>
                 <form action="{{route('new')}}" method="GET">
                     <input type="hidden" name="brand" value="{{$ele->brand}}"/>
                     <input type="hidden" name="id" value="{{$ele->id}}"/>
                     <button id="{{$ele->id}}" class="content_button_search"  @if(!$ele->able) style=" background-color: #a0aec0" @endif >Більше</button>
                 </form>
             </div>
        @endforeach
                       {{$array->links()}}
                </div>
        </div>
        @else
            <div style="height: 460px"><h1 style="text-align: center">Нічого не знайдено!</h1></div>
    @endisset
@endsection

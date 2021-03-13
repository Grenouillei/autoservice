@extends('dashboard')

@section('main_content')
    @if(count($array)<1)
            <h1 style="text-align: center">Нічого не знайдено!</h1>
        @endif
    <div id="content_block_search">
            <div style="margin-left: 45px;">
    @foreach($array as $ele)
     @foreach($mass as $el)
         @if($el->name==$ele->name)
         <div class="content_item_search">
             <div class="content_inner_search">
                 <img src="img/imagecar1.jpg" width="100%" height="100%" alt="">
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
                    <p >{{$el->price}} грн</p>
                </div>
             </div>
             <form action="new" method="GET">
                 <input type="hidden" name="brand" value="{{$el->brand}}"/>
                 <input type="hidden" name="id" value="{{$el->id}}"/>
                 <button id="{{$el->id}}" class="content_button_search"  >Більше</button>
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
   @endsection
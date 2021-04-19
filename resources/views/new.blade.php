@extends('dashboard')

@section('main_content')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <div id="content_block_new">

        @foreach($news as $el)
            @if($el->id==request()->id)
            <div class="content_item_new">
                @if(auth()->user()->admin)
                    <form action="{{route('product.change')}}" method="get">
                        <input type="hidden" name="id" value="{{$el->id}}"/>
                        <button class="change_able">Change able</button>
                    </form>
                    <form action="{{route('product.delete')}}" method="get">
                        <input type="hidden" name="id" value="{{$el->id}}"/>
                        <button class="delete_product">Delete product</button>
                    </form>
                    <form action="{{route('page.product-update')}}" method="get">
                        <input type="hidden" name="id" value="{{$el->id}}"/>
                        <button class="update_product">Change product</button>
                    </form>
                @endif
                <h1  class="content_name_new">{{$el->name}}</h1>
                <div style="padding-top: 20px;" >

                <div class="content_character_new">
                    <h2>Характеристики</h2>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis  deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="content_alias_new">
                    <h2>Заміни</h2>
                    <div class="alias_item">
                        <img src="{{asset('img\details.jpg')}}" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                    <div class="alias_item">
                        <img src="{{asset('img\details.jpg')}}" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                    <div class="alias_item">
                        <img src="{{asset('img\details.jpg')}}" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                    <div class="alias_item">
                        <img src="{{asset('img\details.jpg')}}" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                </div>
                    <img src="{{asset('img\imagecar1.jpg')}}" width="360px" height="280" alt="" @if(!$el->able) style=" filter: grayscale(100%);" @endif><br>
                                <h3> Бренд : {{$el->brand}}</h3>
                        <h3> Каталожний номер : {{$el->code}}</h3>
                            <h3> Ціна : @if(!auth()->user()->premium){{$el->price}} @endif
                                @if(auth()->user()->premium&&$el->able)<b style="color: limegreen">{{$el->price-$el->price*0.1 }}</b> @endif грн</h3>
                    <p style="color: red;position: absolute;margin-left: 180px; margin-top: -37px;">@if(auth()->user()->premium&&$el->able) -10% @endif</p>

                    @if($el->qty<=20&&$el->qty>10)
                        <div class="AvailabilityR">
                            <p>Закінчується</p>
                        </div>
                    @elseif(!$el->able||$el->qty<=10)
                        <div class="AvailabilityN">
                            <p>Нема наявності</p>
                        </div>
                    @else
                        <div class="Availability">
                            <p>В наявності ~{{$el->qty}} шт.</p>
                        </div>
                    @endif
                    <form action="{{route('cart.create')}}" method="GET">
                        @if($el->able&&$el->qty>10)
                            <input type="hidden" name="id" value="{{$el->id}}"/>
                            <button id="{{$el->id}}" class="content_button_busket_new" type="">
                                Купити
                            </button>
                        @else
                            <input type="hidden" name="id" value="{{$el->id}}"/>
                            <button id="button_disabled" type="" disabled >
                                --------
                            </button>
                        @endif
                    </form>
                    @foreach($favorites as $favorite)
                        @if($favorite->id_user==auth()->user()->id&&$favorite->id_good==$el->id)
                            <form action="{{route('favorite.delete')}}" method="GET">
                                <input type="hidden" name="id" value="{{$favorite->id}}"/>
                                <button  class="add_favorite_new1" >Обране</button>
                            </form>
                            @break
                        @else
                            <form action="{{route('favorite.create')}}" method="GET">
                                <input type="hidden" name="id_good" value="{{$el->id}}"/>
                                <button  class="add_favorite_new" >Обране</button>
                            </form>
                        @endif
                    @endforeach
                    <div class="new_icon">
                        <div style="float: left; text-align: center">
                            <img src="{{asset('img\cart.svg')}}" height="19px" width="19px" alt="" >
                            <p >{{$buy}}</p>
                        </div>
                        <div style="position: absolute; margin-left: 50px; text-align: center">
                            <img src="{{asset('img\like.svg')}}" height="18px" width="18px" alt="" >
                            <p >{{$like}}</p>
                        </div>
                        <div style="float: right;text-align: center">
                            <img src="{{asset('img/eye.svg')}}" width="19px" height="19px" alt="">
                            <p>{{$saw}}</p>
                        </div>
                    </div>
                </div>
            </div>
                <script>
                    let temp;
                 @foreach($product as $element)
                  temp = {{$element->id_good}};
                     @if($el->id==$element->id_good&&$element->id_user==auth()->user()->id)
                        $('#'+temp+'').prop('disabled', true);
                        $('#'+temp+'').css('background-color', '#edf2f7');
                        $('#'+temp+'').css('border', '3px solid limegreen');
                        $('#'+temp+'').css('color', 'black');
                        $('#'+temp+'').css('cursor', 'auto');
                        $('#'+temp+'').html('В кошику');
                     @endif
                 @endforeach
                </script>


                <div class="content_feedback_new">
                    <h3>Залиште свій коментар</h3>
                        <div class="feedback_user">
                            <img src="{{asset('img/user.svg')}}" width="100px" height="100px" alt="" style="margin-top: 10px;">
                            <p>{{auth()->user()->name}}</p>
                        </div>
                    <form action="{{route('comment.create')}}" method="post">
                        @csrf
                        <input type="hidden" name="id_user" value="{{auth()->user()->id}}"/>
                        <input type="hidden" name="id_good" value="{{$el->id}}"/>
                        <textarea name="comment" placeholder=" Ваш коментар..."@error('comment')style="border: 1px solid orangered"@enderror></textarea>
                        <button>Опублікувати</button>
                    </form>
                    @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p style="position: absolute; color: red;margin-top: 285px;margin-left: 200px;">{{$error}}</p>
                            @endforeach
                    @endif
                </div>
            @endif
        @endforeach
            @foreach($comments as $comment)
                @if($comment->id_good==request()->id)
                    <div class="all_feedback">
                        <h2>Всі коментарі</h2>
                        @break
                @endif
            @endforeach
        @foreach($comments as $comment)
            @if($comment->id_good==request()->id)
                <div class="feedback_content">
                    <div class="feedback_inner">
                        <p class="feedback_name">{{$comment->getUser()[0]['name']}}</p>
                        <p style="float: right;font-size: 15px;margin-top: 20px;margin-right: 5px;">{{$comment->created_at}}</p>
                    </div>
                    <div class="feedback_inner2">
                        <textarea id="textarea" class="text{{$comment->id}}" name="comment" placeholder="" disabled>{{$comment->comment}}</textarea>
                    </div>
                    <div class="feedback_settings">
                        @if(auth()->user()->admin||$comment->id_user==auth()->user()->id)
                            <form action="{{route('comment.remove')}}" method="get">
                                <input type="hidden" name="id" value="{{$comment->id}}"/>
                                <button class="delete_comment">Видалити</button>
                            </form>
                        @endif
                        @if($comment->id_user==auth()->user()->id)
                            <form action="{{route('comment.update')}}" method="get" id="form_change_comment" class="form_change_comment{{$comment->id}}" style="display: none;">
                                <input type="hidden" id="comment{{$comment->id}}" name="comment" value=""/>
                                <input type="hidden" name="id" value="{{$comment->id}}"/>
                                <button id="{{$comment->id}}" class="change_comment1" >Змінити</button>
                            </form>
                                <button id="{{$comment->id}}" class="change_comment">Змінити</button>
                        @endif
                            <div class="likes_comment">
                                <img src="{{asset('img\like.svg')}}" height="18px" width="18px" alt="" >
                                <img src="{{asset('img\like.svg')}}" height="18px" width="18px" style="transform: rotate(180deg);" alt="" >
                            </div>

                    </div>
                </div>
            @endif
        @endforeach
        <script>
            $(".change_comment").click(function () {
                var clickId = $(this).attr('id');
                $('.text'+clickId+'').prop('disabled', false);
                $('.form_change_comment'+clickId+'').css("display", "block");
                $(this).css("display", "none");
            });
            $(".change_comment1").click(function () {
                var clickId = $(this).attr('id');
                var text = $('.text'+clickId+'').val();
                $('#comment'+clickId+'').val(text);
            });

        </script>
    </div>
    </div>
@endsection



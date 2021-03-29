@extends('dashboard')

@section('main_content')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <div id="content_block_new">

        @foreach($news as $el)
            @if($el->id==$_GET['id'])
            <div class="content_item_new">
                @if($user_admin)
                    <form action="{{route('change')}}" method="get">
                        <input type="hidden" name="id" value="{{$el->id}}"/>
                        <button class="change_able">Change evidence</button>
                    </form>
                    <form action="{{route('delete_pr')}}" method="get">
                        <input type="hidden" name="id" value="{{$el->id}}"/>
                        <button class="delete_product">DELETE PRODUCT</button>
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
                        <img src="img\details.jpg" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                    <div class="alias_item">
                        <img src="img\details.jpg" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                    <div class="alias_item">
                        <img src="img\details.jpg" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                    <div class="alias_item">
                        <img src="img\details.jpg" width="100" height="100" alt="" style="opacity: 70%">
                    </div>
                </div>
                <img src="img\imagecar1.jpg" width="360px" height="280" alt=""><br>
                                <h3> Бренд : {{$el->brand}}</h3>
                        <h3> Каталожний номер : {{$el->code}}</h3>
                            <h3> Ціна : @if(!$user_premium){{$el->price}} @endif
                                @if($user_premium)<b style="color: limegreen">{{$el->price-$el->price*0.1 }}</b> @endif грн</h3>
                    <p style="color: red;position: absolute;margin-left: 180px; margin-top: -37px;">@if($user_premium) -10% @endif</p>

                    @if($el->able)
                    <div class="Availability">
                        <p>В наявності</p>
                    </div>
                    @else
                        <div class="AvailabilityN">
                            <p>Нема наявності</p>
                        </div>
                    @endif
                    <form action="/add" method="GET">
                        @if($el->able)
                            <input type="hidden" name="id" value="{{$el->id}}"/>
                            <button id="{{$el->id}}" class="content_button_busket_new" type="">
                               <!-- <img src="img\cart.svg" height="30px" width="30px" style=""  alt="">-->
                                Купити
                            </button>
                        @else
                            <input type="hidden" name="id" value="{{$el->id}}"/>
                            <button id="button_disabled" type="" disabled >
                                --------
                            </button>
                        @endif
                    </form>

                    <div class="new_icon">
                        <div style="float: left; text-align: center">
                            <img src="img\cart.svg" height="19px" width="19px" alt="" >
                            <p >{{$buy}}</p>
                        </div>
                        <div style="position: absolute; margin-left: 50px; text-align: center">
                            <img src="img\like.svg" height="18px" width="18px" alt="" >
                            <p >{{$like}}</p>
                        </div>
                        <div style="float: right;text-align: center">
                            <img src="img/eye.svg" width="19px" height="19px" alt="">
                            <p>{{$saw}}</p>
                        </div>
                    </div>
                </div>
            </div>
                <script>
                    let temp;
                 @foreach($product as $element)
                  temp = {{$element->id_g}};
                     @if($el->id==$element->id_g&&$element->user_id==\Illuminate\Support\Facades\Auth::user()->id)
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
                            <img src="img/user.svg" width="100px" height="100px" alt="" style="margin-top: 10px;">
                            <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                        </div>
                    <form action="{{route('create_com')}}" method="post">
                        @csrf
                        <input type="hidden" name="id_user" value="{{\Illuminate\Support\Facades\Auth::user()->id}}"/>
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
                @if($comment->id_good==$_GET['id'])
                    <div class="all_feedback">
                        <h2>Всі коментарі</h2>
                        @break
                @endif
            @endforeach
        @foreach($comments as $comment)
            @if($comment->id_good==$_GET['id'])
                <div class="feedback_content">
                    <div class="feedback_inner">
                        <p class="feedback_name">{{$comment->id_user}}</p>
                        <p style="float: right;font-size: 15px;margin-top: 20px;margin-right: 10px;">{{$comment->created_at}}</p>
                    </div>
                    <div class="feedback_inner2">
                        <p >{{$comment->comment}}</p>
                    </div>
                    <div class="feedback_settings">
                        @if($user_admin||$comment->id_user==\Illuminate\Support\Facades\Auth::user()->id)
                            <form action="{{route('remove_com')}}" method="get">
                                <input type="hidden" name="id" value="{{$comment->id}}"/>
                                <button class="delete_comment">Видалити</button>
                            </form>
                        @endif
                        @if($comment->id_user==\Illuminate\Support\Facades\Auth::user()->id)
                            <form action="" method="">
                                <input type="hidden" name="id" value="{{$comment->id}}"/>
                                <button class="change_comment">Змінити</button>
                            </form>
                        @endif
                            <div class="likes_comment">
                                <img src="img\like.svg" height="18px" width="18px" alt="" >
                                <img src="img\like.svg" height="18px" width="18px" style="transform: rotate(180deg);" alt="" >
                            </div>

                    </div>
                </div>

            @endif
        @endforeach

    </div>
    </div>
@endsection



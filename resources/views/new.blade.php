@extends('dashboard')

@section('main_content')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <div id="content_block_new">

                @foreach($news as $el)
                    @if($el->id==$_GET['id'])
                    <div class="content_item_new">
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
                                    <h3> Ціна : {{$el->price}} грн</h3>

                            <div class="Availability">
                                <p>В наявності</p>
                            </div>
                            <form action="/add" method="GET">
                                <input type="hidden" name="id" value="{{$el->id}}"/>
                                <button id="{{$el->id}}" class="content_button_busket_new" type="">
                                   <!-- <img src="img\cart.svg" height="30px" width="30px" style=""  alt="">-->
                                    Купити
                                </button>
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
                          temp = {{$element->id_s}};
                             @if($el->id==$element->id_s&&$element->user_id==\Illuminate\Support\Facades\Auth::user()->id)
                                        $('#'+temp+'').prop('disabled', true);
                                        $('#'+temp+'').css('background-color', '#edf2f7');
                                        $('#'+temp+'').css('border', '3px solid limegreen');
                                        $('#'+temp+'').css('color', 'black');
                                        $('#'+temp+'').css('cursor', 'auto');
                                        $('#'+temp+'').html('В кошику');
                             @endif
                         @endforeach
                        </script>
                    @endif
                @endforeach

            <div class="content_feedback_new">
                <h3>Залиште свій коментар</h3>
                    <div class="feedback_user">
                        <img src="img/user.svg" width="100px" height="100px" alt="" style="margin-top: 10px;">
                        <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                    </div>

                <textarea name="comment" placeholder=" Ваш коментар..."></textarea>
            </div>

    </div>


@endsection



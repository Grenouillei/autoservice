@extends('dashboard')

@section('main_content')
    <div class="user_block">


        <div class="user_admin_settings">
            <br><br>
            @if($user_admin)<p id="user">Користувачі</p>
            <a href="{{route('product')}}" style="text-decoration: none"><p>Ств. нової поз.</p></a>@endif
            <p id="favorite">Обране</p>
            <p>Історія</p>
            <p>Зв'язок з менеджером</p>

            <div class="user_change">
                <a href="{{route('user_s')}}"><button>Змінити Ім'я</button></a>
                <button>Змінити Пароль</button>
            </div>
        </div>
        <div class="user_admin_content">
            <div class="user_admin_inner" style="display: none;">
                <br>
                <a href="{{route('new_user')}}"><button class="user_create_button">CreateNewUser</button></a>
                @foreach($users as $user)
                    @if($user->id!=1&&$user->id!=\Illuminate\Support\Facades\Auth::user()->id)
                        <div class="users_name"><p>{{$user->name}}</p>
                            <div class="block_button_delete">
                                <form action="{{route('remove')}}" method="get">
                                    <input type="hidden" name="id" value="{{$user->id}}"/>
                                    <button class="user_delete_button">DELETE</button>
                                </form>
                            </div>
                            <div class="users_checkbox">
                                <label for="is_admin{{$user->id}}">ADMIN</label>
                                <input type="checkbox" id="is_admin{{$user->id}}" name="id" value="{{$user->id}}" @if($user->admin) checked @endif>
                            </div>
                        </div>
                    @endif
                @endforeach
                <form action="{{route('admin')}}" method="POST" >
                    @csrf
                        <input class="check_id" type="hidden" name="id" value=""/>
                    <button class="button_admin_update" onclick="getCheckedCheckBoxes()">Confirm</button>
                </form>
             </div>
            <div class="user_favorite_block" style="display: none">
                @foreach($favorites as $favorite)
                    @if($favorite->id_user==auth()->user()->id)
                        <div class="favorite_content">
                            <form action="{{route('new')}}" method="get">
                                <input type="hidden" name="id" value="{{$favorite->id_good}}"/>
                                <button class="favorite_inner">
                                    <p>{{$favorite->getGood()[0]['name']}}</p>
                                    <p>{{$favorite->getGood()[0]['code']}}</p>
                                    @if(!$user_premium)<p>{{$favorite->getGood()[0]['price']}} ₴</p>@else
                                                    <p>{{$favorite->getGood()[0]['price']-$favorite->getGood()[0]['price']*0.1}} ₴</p>@endif
                                </button>
                            </form>
                            <form action="{{route('del_favor')}}" method="get">
                                <input type="hidden" name="id" value="{{$favorite->id}}"/>
                                <button class="favorite_delete">
                                    Видалити
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
         </div>

         <!--<div class="premium_img">
             <img src="img/exclamation.svg" width="18px" height="18px" alt="" >
             <div class="ahtung">
                 <p>цдвлацушграшгцурыф</p>
             </div>
         </div>-->
        <div class="user_foto">
            <img src="img/user.svg" width="150px" height="150px" alt="" style="margin-top: 10px;">
            <p class="user_name">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
        </div>

        <div class="user_features">
            <p>Admin : @if($user_admin) Так
                @else Ні @endif
            </p>
            <p>Premium : @if($user_premium)<i>до {{$today}}</i>
                @else
                    <a href="/user_premium"><button class="user_premium">Купити</button></a>
                @endif
            </p>
        </div>
        <div style="margin-left: 30px;">
            <p style="margin-top: 10px;">1$ - 27,90 грн</p>
            <p style="margin-top: 10px;">1€ - 33,00 грн</p>
        </div>
        <div style="margin-top: 6%;margin-left: 10px;">
            <i><p>Зареєстрований з : {{\Illuminate\Support\Facades\Auth::user()->created_at}}</p></i>
        </div>



    </div>
    <script>
        function getCheckedCheckBoxes() {
            var checkboxes = [];
            checkboxes = document.getElementsByName('id');
            console.log(checkboxes);
            var checkboxesChecked = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkboxesChecked.push(checkboxes[i].value);
                    console.log(checkboxes[i].value);
                }
            }
            $('.check_id').val(checkboxesChecked);
            console.log(checkboxesChecked);
        }

        $("#user").click(function () {
            var width = $('.user_admin_content').width();
            if (width>=240){
                $('.user_admin_content').animate({"width": '-=320'});
                $('.user_admin_inner').css("display", "none");
                $('.user_favorite_block').css("display", "none");
            }
            else{
                $('.user_admin_content').animate({"width": '+=320'});
                setTimeout( function(){
                    $('.user_admin_inner').css("display", "block");
                },300);
            }
        });
        $("#favorite").click(function () {
            var width = $('.user_admin_content').width();
            if (width>=240){
                $('.user_admin_content').animate({"width": '-=320'});
                $('.user_favorite_block').css("display", "none");
                $('.user_admin_inner').css("display", "none");
            }
            else{
                $('.user_admin_content').animate({"width": '+=320'});
                setTimeout( function(){
                    $('.user_favorite_block').css("display", "block");
                },330);
            }
        });
    </script>
@endsection

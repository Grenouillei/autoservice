@extends('dashboard')

@section('main_content')
    <div class="user_block">


        <div class="user_admin_settings">
            <br><br>
            @if(auth()->user()->admin)<p id="user">Користувачі</p>
            <a href="{{route('page.product')}}" style="text-decoration: none"><p>Ств. нової поз.</p></a>@endif
            <a href="{{route('page.archive')}}" style="text-decoration: none"><p >Архів заказів</p></a>
            <p id="favorite">Обране</p>
            <p>Історія</p>
            <p>Зв'язок з менеджером</p>

            <div class="user_change">
                @if(auth()->user()->id==1)<button id="change_admin_pass">ChangeAdmPas</button>@endif
                <a href="{{route('page.user-set')}}"><button>Змінити Ім'я</button></a>
                <button>Змінити Пароль</button>
            </div>
        </div>
        <div class="user_admin_content">
            <div class="user_admin_inner" style="display: none;">
                @foreach($users as $user)
                    @if($user->id!=1&&$user->id!=auth()->user()->id)
                        <div class="users_block">
                            <p class="user_name1">{{$user->name}}</p>
                            <p style="font-size: 10px; text-align: left;margin-left: 10px;">{{$user->created_at}}</p>
                            <div>
                                <div class="block_button_delete">
                                    <form action="{{route('user.remove')}}" method="get">
                                        <input type="hidden" name="id" value="{{$user->id}}"/>
                                        <button class="user_delete_button">Видалити</button>
                                    </form>
                                </div>
                                <div class="users_checkbox">
                                    <label for="is_admin{{$user->id}}">ADMIN</label>
                                    <input type="checkbox" id="is_admin{{$user->id}}" name="id" value="{{$user->id}}" @if($user->admin) checked @endif>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <a href="{{route('page.user-new')}}"><button class="user_create_button">Новий Корист.</button></a>
                <form action="{{route('user.admin')}}" method="POST" >
                    @csrf
                        <input class="check_id" type="hidden" name="id" value=""/>
                    <button class="button_admin_update" onclick="getCheckedCheckBoxes()">Готово</button>
                </form>
                    <div style="margin-bottom: 55px; width: 100%;height: 10px;"></div>
             </div>
            <div class="user_favorite_block" style="display: none">
                @isset($favorites)
                @foreach($favorites as $favorite)
                    @if($favorite->id_user==auth()->user()->id)
                        <div class="favorite_content">
                            <form action="{{route('page.new')}}" method="get">
                                <input type="hidden" name="id" value="{{$favorite->id_good}}"/>
                                <button class="favorite_inner">
                                    <p>{{$favorite->getGood()[0]['name']}}</p>
                                    <p>{{$favorite->getGood()[0]['code']}}</p>
                                    @if(!auth()->user()->premium)<p>{{$favorite->getGood()[0]['price']}} ₴</p>@else
                                                    <p>{{$favorite->getGood()[0]['price']-$favorite->getGood()[0]['price']*0.1}} ₴</p>@endif
                                </button>
                            </form>
                            <form action="{{route('favorite.delete')}}" method="get">
                                <input type="hidden" name="id" value="{{$favorite->id}}"/>
                                <button class="favorite_delete">
                                    Видалити
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
                @endisset
            </div>
         </div>

         <!--<div class="premium_img">
             <img src="img/exclamation.svg" width="18px" height="18px" alt="" >
             <div class="ahtung">
                 <p>цдвлацушграшгцурыф</p>
             </div>
         </div>-->
        <div class="user_foto">
            <img src="{{asset('img/user.svg')}}" width="150px" height="150px" alt="" style="margin-top: 10px;">
            <p class="user_name">{{auth()->user()->name}}</p>
        </div>

        <div class="user_features">
            <p>Admin : @if(auth()->user()->admin) Так
                @else Ні @endif
            </p>
            <p>Premium : @if(auth()->user()->premium)<i>до {{$today}}</i>
                @else
                    <a href="{{route('user.premium')}}"><button class="user_premium">Купити</button></a>
                @endif
            </p>
        </div>
        <div class="admin_pass">
            <form action="{{route('change_pass')}}" method="get">
                <input type="text" name="password" />
                <button id="pass_confirm">Confirm</button>
            </form>
            <button id="pass_cancel">Cancel</button>
        </div>
        <div style="margin-left: 30px;">
            <p style="margin-top: 10px;" class="dollar">1$ - {{$usd}} грн</p>
            <p style="margin-top: 10px;" class="euro">1€ - {{$eur}} грн</p>
        </div>
        @if(auth()->user()->admin)
            <div class="update_currency">
                <a href="{{route('update_curr')}}"><button>Оновити</button></a>
            </div>
        @endif
        <div style="margin-top: 3.5%;margin-left: 10px;">
            <i><p>Зареєстрований з : {{auth()->user()->created_at}}</p></i>
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

        $("#change_admin_pass").click(function () {
            $('.admin_pass').css("display", "unset")
        });
        $("#pass_cancel").click(function () {
            $('.admin_pass').css("display", "none")
        });

        $(document).ready(function () {
            var usd = Number ({{$usd}});
            $('.dollar').animate({ num: usd - 3}, {
                duration: 3000,
                step: function (num){
                    this.innerHTML ='1$ - ' +'<b>'+ (num + 3).toFixed(2) +'</b> грн'
                }
            });
            var eur = Number ({{$eur}});
            $('.euro').animate({ num: eur - 3}, {
                duration: 3000,
                step: function (num){
                    this.innerHTML ='1€ - ' +'<b>'+ (num + 3).toFixed(2) + '</b> грн'
                }
            });
        });
    </script>
@endsection

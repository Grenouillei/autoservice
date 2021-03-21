@extends('dashboard')

@section('main_content')
    <div class="user_block">


        <div class="user_admin_settings">
            <br><br>
            @if($user_admin)<p id="user">Користувачі</p>@endif
            <p>Обране</p>
            <p>Історія</p>
            <p>Історія покупок</p>

            <div class="user_change">
                <a href="{{route('user_s')}}"><button>Змінити Ім'я</button></a>
                <a><button>Змінити Пароль</button></a>
            </div>
        </div>
        <div class="user_admin_content">
            <div class="user_admin_inner" style="display: none;">
                <br><br>
                <form action="/user_admin" method="get" >
                @foreach($users as $user)
                    @if($user->id!=1)
                        <div class="users_name"><p>{{$user->name}}</p>
                            <div class="users_checkbox">
                                <label for="isadmin{{$user->id}}">ADMIN</label>
                                <input type="checkbox" id="isadmin{{$user->id}}" name="id" value="{{$user->id}}" @if($user->admin) checked @endif>
                            </div>
                        </div>
                    @endif
                @endforeach
                    <button>confirm</button>
                </form>
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
            <p>Admin : @if($user_admin) Так @endif
                @if(!$user_admin) Ні @endif
            </p>
            <p>Premium : @if($user_premium)<i>до {{$today}}</i>@endif
                @if(!$user_premium)
                    <a href="/user_premium"><button class="user_premium">КУПИТИ</button></a>
                @endif
            </p>
        </div>
        <div style="margin-top: 10%;margin-left: 10px;">
            <i><p>Зареєстрований з : {{\Illuminate\Support\Facades\Auth::user()->created_at}}</p></i>
        </div>



    </div>
    <script>
        $("#user").click(function () {
            var width = $('.user_admin_content').width();
            if (width>=240){
                $('.user_admin_content').animate({"width": '-=230'});
                $('.user_admin_inner').css("display", "none");
            }
            else{
                $('.user_admin_content').animate({"width": '+=230'});
                setTimeout( function(){
                    $('.user_admin_inner').css("display", "block");
                },300);
            }
        });
    </script>
@endsection

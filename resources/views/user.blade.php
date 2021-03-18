@extends('dashboard')

@section('main_content')
    <div class="user_block">
        <div class="user_admin_settings">
            <br><br>
            <p id="user">Користувачі</p>
            <p>Історія покупок</p>
            <p>Історія</p>
            <p>Обране</p>
        </div>
        <div class="user_admin_content">
            <div class="user_admin_inner" style="display: none;">
            @foreach($users as $user)
                <p>{{$user->name}}</p>
            @endforeach
            </div>
        </div>
        <div class="user_features">
            <p>Admin : @if($user_admin) Так @endif
                @if(!$user_admin) Ні @endif
            </p>
            <p>Premium : @if($user_premium)Так @endif
                @if(!$user_premium)
                    <a href="/user_premium"><button class="user_premium">КУПИТИ</button></a>
                @endif
            </p>
        </div>
        <div class="user_foto">
            <img src="img/user.svg" width="180px" height="180px" alt="" style="margin-top: 10px;">
            <p class="user_name">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
        </div>
        <div class="user_change">
            <a href="{{route('user_s')}}"><button>Змінити Ім'я</button></a>
            <a><button>Змінити Пароль</button></a>
        </div>
        <div style="margin-top: 17%;margin-left: 10px;">
            <p>Зареєстрований з : {{\Illuminate\Support\Facades\Auth::user()->created_at}}</p>
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
                $('.user_admin_inner').css("display", "block");
            }
        });
    </script>
@endsection

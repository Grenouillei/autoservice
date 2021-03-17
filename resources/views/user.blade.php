@extends('dashboard')

@section('main_content')
    <div class="user_block">
        <div class="user_admin_settings">

        </div>
        <div class="user_features">
            <p>Admin : @if(\Illuminate\Support\Facades\Auth::user()->admin) Так @endif
                @if(!\Illuminate\Support\Facades\Auth::user()->admin) Ні @endif
            </p>
            <p>Premium : @if(\Illuminate\Support\Facades\Auth::user()->PREMIUM)Так @endif
                @if(!\Illuminate\Support\Facades\Auth::user()->PREMIUM)
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
            <a href="{{route('user_s')}}"><button>Змінити Пароль</button></a>
        </div>

    </div>
@endsection

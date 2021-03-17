@extends('dashboard')

@section('main_content')

     <div class="user_content">
         <h1>Заміна пароля</h1>
        <form action="/user_update" method="GET" >
                <label for="name">Name</label><br>
            <input type="text" name="name" style="@error('name') border: 1px solid red; @enderror" placeholder="Name"><br><br>
                <label for="email">Email</label><br>
            <input type="email" name="email" style="@error('email') border: 1px solid red; @enderror" placeholder="Email"><br><br>
                <label for="password">Password</label><br>
            <input type="password" name="password" style="@error('password') border: 1px solid red; @enderror" placeholder="Password"><br><br>
                <label for="confirm_password">Confirm password</label><br>
            <input type="password" name="confirm_password"  placeholder="Confirm password"><br><br>
                <button type="submit" class="user_button_confirm">Підтвердити</button>
        </form>
         <a href="{{route('user')}}"><button type="submit" class="user_button_back">Назад</button></a>
    </div>

@endsection

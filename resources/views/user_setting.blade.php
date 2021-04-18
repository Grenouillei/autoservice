@extends('dashboard')

@section('main_content')
     <div class="user_content">
         <h1>Заміна Ім'я</h1>
        <form action="{{route('user.update')}}" method="post" >
            @csrf
                <label for="name">Name</label><br>
            <input type="text" name="name" @error('name')style="border: 1px solid orangered"@enderror placeholder="Name"><br><br>
                <label for="email">Email</label><br>
            <input type="email" name="email" @error('email')style="border: 1px solid orangered"@enderror placeholder="Email"><br><br>
                <label for="password">Password</label><br>
            <input type="password" name="password" @error('password')style="border: 1px solid orangered"@enderror placeholder="Password"><br><br>
                <label for="confirm_password">Confirm password</label><br>
            <input type="password" name="confirm_password" @error('password')style="border: 1px solid orangered"@enderror placeholder="Confirm password"><br><br>
                <button type="submit" class="user_button_confirm">Підтвердити</button>
        </form>
         <a href="{{route('page.user')}}"><button type="submit" class="user_button_back">Назад</button></a>
    </div>
     @if($errors->any())
         <div class="user_errors">
             @foreach($errors->all() as $error)
                 <li>{{$error}}</li>
             @endforeach
         </div>
     @endif
@endsection

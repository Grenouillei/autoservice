@extends('dashboard')

@section('main_content')
    <form action="/user_update" method="GET" >
        <input type="text" name="name" style="@error('name') border: 1px solid red; @enderror" placeholder="Name">
        <input type="email" name="email" style="@error('email') border: 1px solid red; @enderror" placeholder="Email">
        <input type="password" name="password" style="@error('password') border: 1px solid red; @enderror" placeholder="Password">
        <input type="password" name="confirm_password"  placeholder="Confirm password">
        <button type="submit">update</button>
    </form>
@endsection

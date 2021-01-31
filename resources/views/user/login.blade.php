@extends('layouts.app')
@section('title', 'Home')
@section('content')

@if (isset($success_register))
    <strong>{{ $data['user_email'] }}</strong>, <span class="success-register">your registration was successfull. Now you can loggin!</span>
@endif

<form method="post" action="/login">
    @csrf
    <label for="user_email">Email: </label>
    <input type="text" id="user_email" name="user_email" placeholder="Enter your Email" /></br>

    <label for="user_password">Password: </label>
    <input type="password" id="user_password" name="user_password" placeholder="Enter your Password" /></br>
    <?php
        if (isset($err) && !empty($err['wrong_login']) ) { echo '<div class="error">' . $err['wrong_login'] . '</div>'; }
    ?>

    <input type="submit" value="OK" />

</form>
if you don't have account: <a href="/register">Register</a>

@endsection
@extends('layouts.app')
@section('title', 'Home')
@section('content')

<form method="post" action="/register">
    @csrf
    <label for="user_name">Name: </label>
    <input type="text" id="user_name" name="user_name" value="<?php if ( isset($data['user_name']) ) { echo $data['user_name']; }  ?>" placeholder="Enter your Name" /></br>
    <?php
        if (isset($err) && !empty($err['user_name']) ) { echo '<div class="error">' . $err['user_name'] . '</div>'; }
    ?>

    <label for="user_email">Email: </label>
    <input type="text" id="user_email" name="user_email" value="<?php if ( isset($data['user_email']) ) { echo $data['user_email']; }  ?>" placeholder="Enter your Email" /></br>
    <?php
        if (isset($err) && !empty($err['user_email']) ) { echo '<div class="error">' . $err['user_email'] . '</div>'; }
    ?>

    <label for="user_password">Password: </label>
    <input type="password" id="user_password" name="user_password" value="<?php if ( isset($data['user_password']) ) { echo $data['user_password']; }  ?>" placeholder="Enter your Password" /></br>
    <?php
        if (isset($err) && !empty($err['user_password']) ) { echo '<div class="error">' . $err['user_password'] . '</div>'; }
    ?>

    <label for="user_repeat_password">Repeat Password: </label>
    <input type="password" id="user_repeat_password" name="user_repeat_password" value="<?php if ( isset($data['user_repeat_password']) ) { echo $data['user_repeat_password']; }  ?>" placeholder="Repeat your Password" />
    <?php
        if (isset($err) && !empty($err['password_not_equal']) ) { echo '<div class="error">' . $err['password_not_equal'] . '</div>'; }
    ?>

    </br></br>
    <input type="submit" value="Save" />

</form>

@endsection
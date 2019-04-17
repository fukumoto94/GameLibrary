@extends('layout')

@section('page', 'Create')

@section('title', 'Create Account')

@section('fields')

    <form action="/create" method="post">
        {{ csrf_field() }}
        New User:<br>
        <input type="text" name="newUser"><br>
        Password:<br>
        <input type="password" name="password"><br>
        Email:<br>
        <input type="text" name="email"><br>
        <input type="submit" name="submit" value="Create">
    </form>

@endsection

@section('links')

<a href="{{asset('login')}}">Ok</a>
<a href="{{asset('/')}}">Home</a>

@endsection


@extends('layout')

@section('page', 'Login')
@section('title', 'Login')


@section('fields')
    <form>
        User:<br>
        <input type="text" name="user"><br>
        Password:<br>
        <input type="text" name="password">
    </form>
@endsection

@section('links')
    <a href="{{asset('/games')}}">Ok</a>
    <a href="{{asset('/')}}">Home</a>
@endsection
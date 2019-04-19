@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
@stop

@section('content')
<div class ="col-md-6 col-lg-6">
    <div class = "panel panel-primary">
        <div class = "panel-heading"> Options</div>
            <div class = "panel-body">
       
            <label><a href="{{route('games.create')}}"><button type="button" class="btn btn-block btn-create btn-sm"><i class="fa fa-plus"></i> add</button></a></label>
            <label><a href="{{route('games.edit')}}"></button></a></label>
            <label><a href="{{route('games.show_all')}}"><button type="button" class="btn btn-block btn-show btn-sm"><i class="fa fa-plus"></i> show</button></a></label>

            </div>
    </div>
</div>
@stop
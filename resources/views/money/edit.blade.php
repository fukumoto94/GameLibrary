@extends('adminlte::page')

@section('title', 'Games')

@section('content_header')
@stop

@section('content')

<body>
<div class="container">

<h1>Edit: {{ $game->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($game, array('route' => array('games.update', $game->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the game!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
@stop
@extends('adminlte::page')

@section('title', 'Games')

@section('content_header')
@stop

@section('content')
<body>
<div class="container">

<h1>Create a game</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'games')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('started_at', 'Start') }}
        {{ Form::date('started_at', \Carbon\Carbon::now(), ['class'=>"form-control"])}}
    </div>
    <div class="form-group">
        {{ Form::label('finished_at', 'Finished') }}
        {{ Form::date('finished_at', \Carbon\Carbon::now()->addDays(30), ['class'=>"form-control"]) }}
    </div>
    <div class="form-group">
        {{ Form::label('user_id', 'userId') }}
        {{ Form::select('user_id', \App\User::orderBy('name')->pluck('name', 'id'),old('user_id'), ['class'=>"form-control"]) }}
    </div>
    {{ Form::submit('Create the game!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
@stop
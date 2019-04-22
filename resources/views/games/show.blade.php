@extends('adminlte::page')

@section('title', 'Games')

@section('content_header')
@stop

@section('content')
<body>
<div class="container">

<h1>Showing: {{ $game->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $game->name }}</h2>
        <p>
            <strong>Description:</strong> {{ $game->description }}<br>
        </p>
    </div>

</div>
</body>
@stop
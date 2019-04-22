@extends('adminlte::page')

@section('title', 'Games')

@section('content_header')
@stop

@section('content')
<body>
<div class="container">

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Options</td>
        </tr>
    </thead>
    <tbody>
    @foreach($games as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'games/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Game', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <!-- show the game (uses the show method found at GET /games/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('games/' . $value->id) }}">Show this Game</a>

                <!-- edit this game (uses the edit method found at GET /games/{id}/edit -->
                <a class="btn btn-small btn-info"  href="{{ URL::to('games/' . $value->id . '/edit') }}">Edit this Game</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
@stop

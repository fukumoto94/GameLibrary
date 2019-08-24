@extends('adminlte::page')

@section('title', 'Money')

@section('content_header')

@stop

@section('content')

<body>
<div class="container">


<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

@foreach ($money as $m)
<h1>Edit: {{ $m->money_type_id }}</h1>

{{ Form::model($m, array('route' => array('money.update', $m->id), 'method' => 'PUT')) }}

<div class="form-group">
    {{ Form::label('name', $m->money_type_id) }}
    {{ Form::text('account_balance', $m->account_balance, array('class' => 'form-control')) }}
</div>

<button type="submit" display="none" class="btn btn-primary sub">Edit the money</button>

{{ Form::close() }}
@endforeach

<button type="submit" class="btn btn-primary submitAll">Edit the money</button>


</div>
</body>
@stop

<script>


</script>

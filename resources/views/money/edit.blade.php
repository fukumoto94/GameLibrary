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

{{ Form::model($m, array('method' => 'POST', 'id' => 'form-'.$m->id)) }}

<div class="form-group">
    {{ Form::label('name', $m->money_type_id) }}
    {{ Form::text('account_balance', $m->account_balance, array('class' => 'form-control')) }}
</div>

{{-- <button style='display:none' class="btn btn-primary sub">Edit the money</button> --}}

{{ Form::close() }}
@endforeach

<button href="/moneyedit" type="submit" class="btn btn-primary submitAll">Edit the money</button>


</div>
</body>
@stop
@section('js')

<script>
    $(document).ready(function() {

        var money = {!! $money !!}
        $('.submitAll').on('click', function(){
            money.forEach(m => {
                var formData = JSON.stringify($('form-'+m['id']))
                var url = "/moneyedit";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(d){
                        console.log(d);
                    },
                    error: function(e){
                        console.log(e);
                    }

                });
            });
        });
    });
</script>
@endsection


@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('message.edit_money_type')</h3>
    </div>
    {!! Form::model($moneyType,['method' => 'PATCH','route' => ['money_type.update', $moneyType]]) !!}
    <div class="box-body">
      <div class="form-group">
        <label for="name">@lang('message.name')</label>
        <input type="text" class="form-control" id="name" placeholder="{{__('message.name')}}" name="name" value="{{ $moneyType->name  }}">
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">@lang('message.save')</button>
      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
@stop

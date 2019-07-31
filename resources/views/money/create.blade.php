@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('message.new_money')</h3>
    </div>
    {!!Form::model($money, ['route' => ['money.store', $money]])!!}
    @forelse ($moneyType as $m)
        <div class="form-group col-md-12">
            <label for="name">{{$m->name}}</label>
            <input type="text" class="form-control"  placeholder="{{__('message.name')}}" name="account_balance{{$m->id}}" value="{{old('name')}}">
            <input type='hidden' name="id{{$m->id}}" value='{{$m->id}}'>
        </div>

    @empty
        <tr><td colspan="2" class='text-center bg-yellow'>@lang('message.no_records_found')</td></tr>
    @endforelse
    <div class="box-footer">
            <button type="submit" class="btn btn-primary">@lang('message.save')</button>
        </div>
    {!!Form::close()!!}


  </div>
</div>
@stop

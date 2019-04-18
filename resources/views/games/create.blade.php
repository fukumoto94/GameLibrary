@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
@stop

@section('content')
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('message.new_project')</h3>
    </div>
    <form role="form" action="{{route('games.store')}}" method="POST">
      @csrf
      <div class="box-body">
        <div class="form-group">
          <label for="name">@lang('message.name')</label>
          <input type="text" class="form-control" id="name" placeholder="{{__('message.name')}}" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
          <label>@lang('message.description')</label>
          <textarea class="form-control" rows="3" placeholder="{{__('message.description')}}" name="description" value="{{ old('description') }}"></textarea>
        </div>
        <div class="form-group">
          <label>@lang('message.date_init')</label>
          {{\Form::date('started_at', \Carbon\Carbon::now(),['class'=>"form-control", 'placeholder'=>__('message.selected')])}}
        </div>
        <div class="form-group">
          <label>@lang('message.date_finish')</label>
          {{\Form::date('finished_at', \Carbon\Carbon::now()->addDays(30),['class'=>"form-control", 'placeholder'=>__('message.selected')])}}
        </div>
        @canany(['admin','user'])
          <div class="form-group">
            <label>@lang('message.user')</label>
            {{\Form::select('user_id', \App\Company::orderBy('name')->pluck('name', 'id'),old('user_id'),['class'=>"form-control", 'placeholder'=>__('message.selected')])}}
          </div>
            @else
            <input type='hidden' name='user_id' value='{{Auth::user()->user_id}}'>
        @endcanany
      </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">@lang('message.save')</button>
        </div>
    </form>
  </div>
</div>
@stop

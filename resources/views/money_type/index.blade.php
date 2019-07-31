@extends('adminlte::page')

@section('title', 'Money Type')

@section('content_header')
@stop

@section('content')
<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('message.moneyType')</h3>
                    <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                        <div class="btn-group" data-toggle="btn-toggle">
                          <a href="{{route('money_type.create')}}"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i></button></a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="example1_filter" class="dataTables_filter">
                                    <label>@lang("message.search"):<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th width='50%' tabindex="0" aria-controls="example1">@lang('message.name')</th>
                                            @can('admin')
                                            <th  tabindex="1" aria-controls="example1">@lang('message.company')</th>
                                            @endcan
                                            <th  width='10%' tabindex="4" aria-controls="example1" width='15%'>@lang('message.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($moneyType as $c)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" ><a href="{{route('money_type.edit', $c)}}">{{ $c->name }}</a></td>
                                            <td class="sorting_1" width='10%'>
                                                <a href="{{route('money_type.edit', $c)}}" class="btn btn-xs btn-primary" ><i class="fa fa-edit"></i></a>
                                                <button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalExcludeConfirm' data-link="{{route('money_type.destroy', $c)}}" data-text='{{$c->name}}'><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr><td colspan="2" class='text-center bg-yellow'>@lang('message.no_records_found')</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {{ $moneyType->links()}}
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.modal')
@stop

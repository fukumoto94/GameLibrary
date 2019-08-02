@extends('adminlte::page')

@section('title', 'Money')

@section('content_header')
@stop

@section('content')
<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('message.money')</h3>
                    <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                        <div class="btn-group" data-toggle="btn-toggle">
                          <a href="{{route('money.create')}}"><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i></button></a>
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
                                                <th tabindex="0" aria-controls="example1">DATE</th>

                                            @forelse ($moneyType as $type)
                                                <th tabindex="2" aria-controls="example1">{{$type->name}}</th>
                                            @empty
                                            @endforelse
                                            <th tabindex="4" aria-controls="example1" width='5%'>Toda grana</th>
                                            <th tabindex="4" aria-controls="example1" width='5%'>@lang('message.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($money as $e)
                                        <tr role="row" class="odd">
                                                <td class="sorting_1"><a class="startDate-{{$e->id}}"></a></td>

                                            @forelse ($moneyType as $type)
                                                <td class="sorting_1 "><a class="{{$e->id}}{{$type->id}}"></a></td>
                                            @empty
                                            @endforelse
                                            <td class="sorting_1"><a class="totalValue-{{$e->id}}">{{ $e->name }}</a></td>
                                            <td class="sorting_1">
                                                <a href="{{route('money.edit', $e)}}" class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a>
                                                {{ Form::open(['route' => ['money.destroy', $e], 'method' => 'delete', 'style'=>'display:inline']) }}
                                                    <button class='btn btn-sm btn-danger'><i class="fa fa-trash"></i></button>
                                                {{ Form::close()}}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr><td colspan="5" class='text-center bg-yellow'>@lang('message.no_records_found')</td></tr>
                                        @endforelse
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><a>Lucro</a></td>
                                            @forelse ($moneyType as $type)
                                                <td class="sorting_1 "><a class="{{$type->id}}"></a></td>
                                            @empty
                                            @endforelse

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                   <!--{ { $money->links()}}-->
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

@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    function setTypes($types){
        var totalValue = 0;
        $types.forEach(type => {
            var moneyId = type['moneyId'];
            var typeId = type['moneyTypeId'];
            var typeValue = type[typeId];
            totalValue+=typeValue;

            $('.'+moneyId+typeId).html(typeValue);


            var typeTotalValue = (Number($('.'+typeId).html()) - Number($('.'+moneyId+typeId).html())) * -1;

            $('.'+typeId).html(typeTotalValue);
        });
        $('.totalValue-'+$types[0]['moneyId']).html(totalValue);
        $('.startDate-'+$types[0]['moneyId']).html($types[0]['date']);
       // $('.'+$)

        /*
        var negative = -23,
    positive = -negative>0 ? -negative : negative;
        */
    }

    var getTypes = function(e) {
        var urlStatus = "{{ url('/money/') }}/"+{!! $money !!}[e]['id']+"/types";
        $.ajax({
            type:'GET',
            url: urlStatus,
            timeout: 5000,
            success:function(data){
                setTypes(data);
            },
            error:function () {
                console.log("Sem acesso ao server.");
            }
        });
    }

    for (let i = 0; i < {!! $money !!}.length; i++) {
        getTypes(i);
    }
</script>
@endsection

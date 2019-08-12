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
                                            <tr role="row" class="odd">
                                                    <td class="sorting_1"><a>Lucro Total</a></td>
                                                    @forelse ($moneyType as $type)
                                                        <td class="sorting_1 "><a class="total-gain-{{$type->id}}"></a></td>
                                                    @empty
                                                    @endforelse
                                                    <td class="sorting_1"><a class="total-allgain"></a></td>
                                                </tr>
                                            <tr role="row" class="odd">
                                                    <td class="sorting_1"><a>Lucro</a></td>
                                                    @forelse ($moneyType as $type)
                                                        <td class="sorting_1 "><a class="gain-{{$type->id}}"></a></td>
                                                    @empty
                                                    @endforelse
                                                    <td class="sorting_1"><a class="allgain"></a></td>
                                                </tr>

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

<script>
    function setTypes(types){
        var totalValue = 0;
        types.forEach(type => {
            var moneyId = type[0];
            var typeId = type[1];
            var typeValue = type[2];
            totalValue+=typeValue;
            $('.'+moneyId+typeId).text(typeValue);
        });
        $('.startDate-'+types[0][0]).text(types[0][3]);


       // $('.'+$)
        /*
        var negative = -23,
    positive = -negative>0 ? -negative : negative;
        */

       //$('.lucro-total'+firsMoney[])


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
            },
            complete:function(data){
            }

        });
    }
    $( document ).ajaxStop(function() {
        var money = {!! $money !!};
        var moneyChild = {!! $moneyChild !!};

        for (let i = 0; i < money.length; i++) {
            var sum = 0;
            for (let j = 0; j < moneyChild.length; j++) {
                if(money[i]['id'] == moneyChild[j]['parent_id']){
                    sum+=parseInt(moneyChild[j]['account_balance']);
                }
            }
            $('.totalValue-'+money[i]['id']).text(sum);
            console.log(sum);
        }

        if(money.length > 0){
            $('.total-allgain').text(
            parseInt($('.totalValue-'+money[0]['id']).text()) -
            parseInt($('.totalValue-'+money[money.length - 1]['id']).text())
        );
        $('.allgain').text(
            parseInt($('.totalValue-'+money[0]['id']).text()) -
            parseInt($('.totalValue-'+money[1]['id']).text())
        );
        }
   });

    for (let i = 0; i < {!! $money !!}.length; i++) {
        getTypes(i);
    }
    var getGains = function(){
        $.ajax({
            type: "GET",
            url: "{{ url('/ajaxRequest') }}",
            timeout: 5000,
            dataType: "json",
            success:function(data){
                setGains(data);
            },
            error:function(){
                console.log("Sem acesso json");
            }
        });
    }
    setInterval(getGains(), 1000);


    function setGains(gains){
        gains['total'].forEach(gain => {
            $('.total-gain-'+gain['id']).text(gain['value']);
        });
        gains['last'].forEach(gain => {
            $('.gain-'+gain['id']).text(gain['value']);
        });
    }

</script>
@endsection

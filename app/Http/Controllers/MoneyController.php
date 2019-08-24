<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Money;
use App\MoneyType;
class MoneyController extends Controller
{
    public function _contruct()
    {
        $this->middleware(['auth', 'can:all']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$money = Money::all();
        $money = Money::orderBy('created_at', 'DESC')->whereNull('parent_id')->get();
        $moneyChild = Money::orderBy('created_at', 'DESC')->whereNotNull('parent_id')->get();
        //$money = Money::all();
        $moneyType = MoneyType::orderBy('name')->get();
        $moneyLen = count($money);
        return view('money.index', compact('money', 'moneyType', 'moneyLen', 'moneyChild'));
    }

    public function ajaxRequest(){
        $money       = Money::orderBy('created_at')->whereNull('parent_id')->get();
        $moneyType     = MoneyType::all();

        $last        = Money::where('parent_id', $money[count($money) - 2]['id'])->get();
        $lastCreated = Money::where('parent_id', $money[count($money) - 1]['id'])->get();
        $totalGains = array();
        $lastGains  = array();

        foreach ($moneyType as $t) {
            $value = Money::orderBy('created_at')->where('money_type_id', $t->id)
                                        ->whereNotNull('account_balance')->get();

            $valueLast = Money::orderBy('created_at', 'DESC')->where('money_type_id', $t->id)
                                        ->whereNotNull('account_balance')->get();

            if(count($value) <= 0 ){
                array_push($totalGains,
                ([
                    'id' => $t->id,
                    'value' => 0
                ]));
                array_push($lastGains,
                ([
                    'id' => $t->id,
                    'value' => 0
                ]));
            }
            elseif(count($valueLast) > 0){
                array_push($totalGains,
                ([
                    'id' => $t->id,
                    'value' => $valueLast[0]['account_balance'] - $value[0]['account_balance']
                ]));
                array_push($lastGains,
                ([
                    'id' => $t->id,
                    'value' => $valueLast[0]['account_balance'] - $valueLast[1]['account_balance']
                ]));
            }


        }
/*
        for ($i = 0; $i < count($moneyType); $i++) {
            if(count($lastCreated) == count($moneyType) && count($last) == count($moneyType)){
                array_push($lastGains,
                ([
                    'id'    => $lastCreated[$i]['money_type_id'],
                    'value' => $lastCreated[$i]['account_balance'] - $last[$i]['account_balance']
                ]));
            } elseif(count($lastCreated) == count($moneyType)){
                array_push($lastGains,
                ([
                    'id'    => $lastCreated[$i]['money_type_id'],
                    'value' => $lastCreated[$i]['account_balance']
                ]));
            } elseif(count($last) == count($moneyType)){
                array_push($lastGains,
                ([
                    'id'    => $lastCreated[$i]['money_type_id'],
                    'value' => $last[$i]['account_balance']
                ]));
            } else{
                array_push($lastGains,
                ([
                    'id'    => $lastCreated[$i]['money_type_id'],
                    'value' => 0
                ]));
            }

        }
*/
        $gains = ['total' => $totalGains,
                  'last'  => $lastGains
                ];
        return response()->json($gains, 200);
    }

    public function types($id)
    {
        $money = Money::find($id);
        $moneyTypes = Money::where('parent_id', $money->id)->get();
        $date =  \Carbon\Carbon::parse($money->created_at)->format('d/m/y');

        $typesArray = array();

        foreach ($moneyTypes as $t) {
            $types = [
                $t->parent_id,
                $t->money_type_id,
                $t->account_balance,
                $date
            ];
            array_push($typesArray, $types);
        }

        return response()->json($typesArray, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $money = new Money();
        $moneyType = MoneyType::orderBy('name')->get();
        return view('money.create', compact('money', 'moneyType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $moneyType = MoneyType::all();
        $money = new Money();
        $money->save();

        $parentId = $money->id;

        foreach ($moneyType as $type) {
            $typeId = 'id' . $type->id;
            $typeAccountBalance = 'account_balance' . $type->id;

            $money = new Money();
            $money->user_id = auth()->user()->id;
            $money->money_type_id = $request->$typeId;
            $money->account_balance = $request->$typeAccountBalance;
            $money->parent_id = $parentId;
            $money->save();
        }

        return redirect('money');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function show(Money $money)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $money = Money::where('parent_id', $id)->get();
        return view('money.edit', compact('money'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Money $money)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function destroy(Money $money)
    {
        dd($money);
        //
    }
}

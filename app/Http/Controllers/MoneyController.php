<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Money;
use App\MoneyType;
use Auth;

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
        $money = Money::orderBy('created_at')->whereNull('parent_id')->get();
        //$money = Money::all();
        $moneyType = MoneyType::orderBy('name')->get();
        return view('money.index', compact('money', 'moneyType'));
    }

    public function types($id)
    {
        $money = Money::find($id);
        $moneyTypes = Money::where('parent_id', $money->id)->get();
        $date =  \Carbon\Carbon::parse($money->created_at)->format('d/m/y');


        $typesArray = array();

        foreach ($moneyTypes as $t) {
            $types = [
                'moneyId'         => $t->parent_id,
                'moneyTypeId'     => $t->money_type_id,
                $t->money_type_id => $t->account_balance,
                'date'            => $date
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
    public function edit(Money $money)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Money  $money
     * @return \Illuminate\Http\Response
     */
    public function destroy(Money $money)
    {
        //
    }
}

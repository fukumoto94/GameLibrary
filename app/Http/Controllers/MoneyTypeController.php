<?php

namespace App\Http\Controllers;

use App\MoneyType;
use Illuminate\Http\Request;

class MoneyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moneyType = MoneyType::paginate(config('config.paginate'));
        return view('money_type.index', compact('moneyType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $moneyType = new MoneyType();
        return view('money_type.create', compact('moneyType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $moneyType = new MoneyType();
        $moneyType->name = $request->name;
        $moneyType->save();

        return redirect('money_type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MoneyType  $moneyType
     * @return \Illuminate\Http\Response
     */
    public function show(MoneyType $moneyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MoneyType  $moneyType
     * @return \Illuminate\Http\Response
     */
    public function edit(MoneyType $moneyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MoneyType  $moneyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MoneyType $moneyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MoneyType  $moneyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoneyType $moneyType)
    {
        //
    }
}

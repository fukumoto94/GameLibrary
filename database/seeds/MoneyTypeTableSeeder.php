<?php

use Illuminate\Database\Seeder;
use App\MoneyType;

class MoneyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moneyType = new MoneyType();
        $moneyType->name  = "Nubank";
        $moneyType->save();

        $moneyType = new MoneyType();
        $moneyType->name  = "Banco do brasil";
        $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Caixa";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Tes.Selic Prefixado 2029";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Tes.Selic";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Tes.Selic Prefixado 2025";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Selection";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Alaska";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Daycoval";
        // $moneyType->save();

        // $moneyType = new MoneyType();
        // $moneyType->name  = "Equitas";
        // $moneyType->save();
    }
}

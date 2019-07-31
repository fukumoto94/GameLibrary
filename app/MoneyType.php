<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyType extends Model
{
    use Uuids;
    public $incrementing = false;

    public function money(){
        return $this->belongsTo('App\Money');
    }
}

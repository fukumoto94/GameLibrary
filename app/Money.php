<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use Uuids;
    public $incrementing = false;

    protected $fillable = [
        'name'

    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function moneyType(){
        return $this->hasMany('App\MoneyType');
    }
}

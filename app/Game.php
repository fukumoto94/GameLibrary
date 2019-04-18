<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use Uuids;
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description'

    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function coin(){
        return $this->belongsTo('App\Coin');
    }
}

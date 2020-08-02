<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    public function markets(){
        return $this->belongsTo('App\Market');
    }

    public function wallets(){
        return $this->hasMany('App\Wallet');
    }
    public function trades(){
        return $this->hasMany('App\Trade');
    }
}

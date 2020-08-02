<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'user_id', 'coin_id', 'type', 'min', 'max', 'price_usd', 'price_ngn'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function coin(){
        return $this->belongsTo('App\Coin');
    }
    public function trades(){
        return $this->hasMany('App\Trade');
    }
}

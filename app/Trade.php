<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = ['seller_has_summoned', 'buyer_has_summoned'];
    public function coin(){
        return $this->belongsTo('App\Coin');
    }
    public function market(){
        return $this->belongsTo('App\Market');
    }
    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }
}

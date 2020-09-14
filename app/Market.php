<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'user_id', 'coin_id', 'type', 'min', 'max', 'rate', 'is_special'
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

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function rating(){
        if ($this->is_special == 1){
            return 5;
        }
        $rating = $this->reviews()->avg('star');

        if ($rating > 0){
            return $rating;
        }
        return 1;
    }
}

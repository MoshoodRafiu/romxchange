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

    public function rating(){
        if ($this->is_special == 1){
            return 5;
        }
        $sum = 0;
        $count = 0;
        foreach ($this->trades as $trade){
            $sum += $trade->reviews->sum('star');
            $count += $trade->reviews->count('star');
        }
        if ($count > 0){
            return round($sum/$count);
        }
        return 1;
    }
}

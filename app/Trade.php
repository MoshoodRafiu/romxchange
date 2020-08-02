<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    public function coin(){
        return $this->belongsTo('App\Coin');
    }
    public function market(){
        return $this->belongsTo('App\Market');
    }
}

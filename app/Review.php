<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function trade(){
        return $this->belongsTo('App\Trade');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function market(){
        return $this->belongsTo('App\Market');
    }
}

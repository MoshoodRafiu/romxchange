<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ['user_id', 'account_name', 'account_number', 'bank_name'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}

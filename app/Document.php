<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_url', 'photo_url'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}

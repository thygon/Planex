<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    protected $fillable = [
      'amount','user_id'
    ];
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function history(){
    	return $this->hasMany('App\Acchistory');
    }
}

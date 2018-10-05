<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acchistory extends Model
{
    
    protected $fillable = [
      'account','description'
    ];
    public function account(){
    	return $this->belongsTo('App\Account');
    }

    public function getAccountAttribute($value){
    	return unserialize($value);
    }
}

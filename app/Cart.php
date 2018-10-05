<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    
    protected $fillable = [
        'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];
    public function details(){
    	return $this->hasMany('App\CartItem','details_id');
    }

    public function owner(){
    	return belongsTo('App\User');
    }
}

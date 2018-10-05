<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = [
      'cart','address','name','status'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function payment(){
    	return $this->hasOne('App\Payment');
    }

    public function getCartAttribute($value){
    	return unserialize($value);
    }

    public function comments(){
        return $this->hasMany('App\Comment','order_id');
    }
}

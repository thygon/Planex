<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
      'quantity','product_id','details_id'
    ];

    public function cart(){
    	return $this->belongsTo('App\Cart','details_id');
    }

    public function product(){
    	return $this->belongsTo('App\Product');
    }

    public function getCustomAttribute($value){
        return unserialize($value);
    }
    
}

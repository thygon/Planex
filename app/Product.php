<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   

	protected $fillable = [
      'label','slug','price','details','image'
	];
	
    public function details(){
    	return $this->belongsTo('App\ProductDetails','details');
    }

    public function cartItem(){
    	return $this->hasOne('App\CartItem');
    }
}

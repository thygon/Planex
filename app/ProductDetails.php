<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{   
	protected $fillable = [
      'tent','mc','dj','system','seat','tent_size'
	];

    public function product(){
    	return $this->hasOne('App\Product','details');
    }

    public function tentSize(){
    	return $this->belongsTo('App\TentSizes','tent_size');
    }
}

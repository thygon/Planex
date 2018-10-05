<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TentSizes extends Model
{
    protected $fillable = [
        'size','seats','price'
    ];

    public function productDetails(){
    	return belongsTo('App\ProductDetails','tent_size');
    }
}

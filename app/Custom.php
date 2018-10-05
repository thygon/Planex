<?php

namespace App;
use App\TentSizes;
use App\Item;

class Custom
{
    private $dj;
    private $mc;
    private $system;
    private $seat;
    private $tent;
    private $tent_size;

    private $dj_price;
    private $mc_price;
    private $system_price;
    private $seat_price;
    private $tentsize_price;

    public function __construct($dj,$mc,$system,$tent,$tentsize){

    	$this->dj = $dj;
    	$this->mc = $mc;
    	$this->system = $system;
    	$this->tent = $tent;
    	$this->tent_size = $tentsize;

      //prices

      $this->dj_price = Item::where('name','dj')->first()->price;
      $this->mc_price = Item::where('name','mc')->first()->price;
      $this->system_price = Item::where('name','system')->first()->price;
      $this->tentsize_price = TentSizes::find($tentsize)->price;

      $this->seat = TentSizes::find($tentsize)->seats* $this->tent;
    }

    public  function getCustomCart(){
    	$data = [
          'dj'=>$this->dj,
          'mc'=>$this->mc,
          'system'=>$this->system,
          'seat'=>$this->seat,
          'tent'=>$this->tent,
          'tent_size'=>$this->tent_size,
          'price'=>$this->getPrice()
    	];
    	return $data;
    }

    public function getPrice(){
      $total = 0;
      $total += $this->dj* $this->dj_price;
      $total += $this->mc* $this->mc_price;
      $total += $this->system* $this->system_price;
      $total += $this->tent* $this->tentsize_price;
      return $total;
    }
}

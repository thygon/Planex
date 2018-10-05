<?php

namespace App;

use Auth;
use App\User;
use App\Account;
use App\Acchistory;

Class Charge{

	public static function mpesa($code){
		$amount = 30000;
		return $amount;
	}

	public static function debit($amount){
       $acc = Account::where('user_id',Auth::id())->first();
       if($acc){
       	$acc->amount = $acc->amount+$amount;
        $acc->save();
       }else{
       	$acc = new Account();
       	$acc->amount = $amount;
       	Auth::user()->account()->save($acc);
       }
        $history = new Acchistory();
		$history->account = serialize($acc);
		$history->description = 'Deposited '.$amount;
		$acc->history()->save($history);

       return true;
	}

	public static function credit($amount){

      $acc = Account::where('user_id',Auth::id())->first();
      if($amount > $acc->amount){
        $newbal = $amount - $acc->amount;
      }else{
        $newbal = $acc->amount - $amount;
      }
      $acc->amount = $newbal;
      $acc->save();

        $history = new Acchistory();
		$history->account = serialize($acc);
		$history->description = 'Withdrawal of '.$amount;
		$acc->history()->save($history);
      return true;
	}

	public static function bal(){
		$acc = Account::where('user_id',Auth::id())->first();
		if($acc){
          return $acc->amount;
		}else{
          return 0;
		}
	}
}
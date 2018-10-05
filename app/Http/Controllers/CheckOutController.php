<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest as Crequest;
use Auth;
use App\User;
use App\Profile;
use App\Cart;
use App\Order;
use App\Account;
use App\Payment;
use App\Charge;
use Carbon\carbon;

class CheckOutController extends Controller
{
    
    public function __construct(){
    	$this->middleware('auth');
    }

    public function checkOutView(){
    	$cart = Cart::where('user_id',Auth::id())->with('details')->first();
        $user = User::with('profile')->find(Auth::id());
        $order = Order::where('user_id',Auth::id())->first();
        $account =  Account::where('user_id',Auth::id())->first();
    	return view('front.cart.checkout',['cart'=>$cart,'user'=>$user,
                    'order'=>$order,'account'=>$account]);
    }


    public function checkOut(Crequest $request){


         $today = carbon::now();
         $from = Carbon::parse($request->from);
         $to = Carbon::parse($request->to);
         
         if($from->diffInDays($today) < 0 || $to->diffInDays($today)< 1){
            return redirect()->back()->with(['status'=>'error','msg'=>'Incorrect dates!']);
         }else
         {

         $user = Auth::user();
         $total = $request->get('total');
         $cart = Cart::where('user_id',Auth::id())->with('details')->first();
         
         if($request->code != null){
            $depo = Charge::mpesa($request->code);
            $debit = Charge::debit($depo);
         }
         


         $acc_bal = Charge::bal();
         if($acc_bal>= $total){
            //credit
            $credit = Charge::credit($total);
            if($credit){
                $order = new Order();
                $order->cart = serialize($cart);
                $order->name = $user->firstname.' '.$user->lastname;
                $order->address = $request->get('address');
                $order->from = $request->get('from');
                $order->to = $request->get('to');
                $order->status = 1;
                $user->orders()->save($order);

                $this->dropCart();

                $payment = new Payment();
                $payment->balance = $total;
                $payment->status = true;

                $order->payment()->save($payment);
            } 
            $profile = Profile::where('user_id',Auth::id())->first();
            if($profile){
                $profile->address = $request->get('address');
                $profile->phone = '';
                $profile->save();
            }else{
                $profile = new Profile();
                $profile->address = $request->get('address');
                $profile->phone = '';
                $user->profile()->save($profile);
            }

           return redirect(route('my.orders'))->with(['status'=>'success','msg'=>'Order sent!']);

          
         }else{
           return redirect()->back()->with(['status'=>'error','msg'=>'Credit account to order!']);
         }
     }
        
    }

    public function dropCart(){
        $cart = Cart::where('user_id',Auth::id())->first();
        $items = $cart->details()->first();
        $cart->delete();
        $items->delete();
        return true;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Order;
use App\Cart;
use App\Account;
use App\Profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function contact(){

        $cart = Cart::where('user_id',Auth::id())->with('details')->first();

        return view('front.contact',['cart'=> $cart]);
    }

    public function myProfile(){
        
     $profile = Auth::user()->profile()->first();
     $cart = Cart::where('user_id',Auth::id())->with('details')->first();
     $orders = Order::where('user_id',Auth::id())->with('payment')->get();

     return view('front.user.profile',['profile'=>$profile,'cart'=>$cart,'orders'=>$orders]);
    }

    public function myAccount(){

        $cart = Cart::where('user_id',Auth::id())->with('details')->first();
        $orders = Order::where('user_id',Auth::id())->with('payment')->get();
        $account = Account::where('user_id',Auth::id())->with('history')->first();

     return view('front.user.account',['account'=>$account,'cart'=>$cart,'orders'=>$orders]);
    }
}

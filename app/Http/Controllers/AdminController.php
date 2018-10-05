<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;
use App\Item;
use App\Payment;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware(['auth','isadmin']);
    }

    public function index(){

    	$orders = Order::all();
    	$users = User::where('isadmin',0)->get();
    	$items = Item::all();
    	return view('admin.admin',[
    		'orders'=>$orders,
    		'customers'=>$users,
    		'items'=>$items,
    	]);
    }

    public function payments(){
          return view('admin.payment',['payments'=>Payment::OrderBy('created_at')->get()]);
    }
}

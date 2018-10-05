<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Cart;
use App\Comment;
use App\Account;
use App\Acchistory as History;
use App\Product;

class OrderController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function orders(){
     $orders = Order::OrderBy('created_at','desc')->get();
     return view('admin.orders',['orders'=>$orders]);
    }

    public function index(){
    	$orders = Order::where('user_id',Auth::id())->with('payment')->get();
    	$cart = Cart::where('user_id',Auth::id())->with('details')->first();

    	return view('front.cart.order',['orders'=> $orders,'cart'=>$cart]);
    }

    public function confirmOrder($id){
    	$order = Order::findOrFail($id);
    	$order->status = 4;
    	$order->save();
        return redirect()->back()->with([
            'status'=>'sucess',
            'message'=>'Order confirmed'
        ]);
    }

    public function rejectOrder($id){
        $order = Order::findOrFail($id);
    	$order->status = 5;
    	$order->save();

        return redirect()->back()->with([
            'status'=>'sucess',
            'message'=>'Order rejected'
        ]);
    }

     public function ship($id){
        $order = Order::findOrFail($id);
        $order->status = 3;
        $order->save();

        return redirect()->back()->with([
            'status'=>'sucess',
            'message'=>'Order set for shipping'
        ]);
    }

     public function receive($id){
        $order = Order::findOrFail($id);
        $order->status = 6;
        $order->save();

        return redirect()->back()->with([
            'status'=>'sucess',
            'message'=>'Order received '
        ]);
    }

    public function commentOrder(Request $req){
        $req->validate([
            'comment'=>'required'
        ]);
        $order = Order::findOrFail($req->getter);
        $comment = new Comment();
        $comment->comment = $req->comment;
        $order->comments()->save($comment);

        return redirect()->back()->with([
            'status'=>'sucess',
            'message'=>'Comment sent'
        ]);
    }

    public function deleteOrder($id){
        $order = Order::find($id);
        $total = 0;
        foreach ($order->cart->details as $detail) {
            if($detail->product_id == 0){
                $total = $detail->custom['price'];
            }else{
                $product = Product::find($detail->product_id);
                $total = $product->price;
            }
            
        }
        $order->delete();
        $account = Account::where('user_id',Auth::id())->first();
        $account->amount = $account->amount + $total;
        $account->save();

        $h = new History();
        $h->account = serialize($account);
        $h->description = 'Refund of '.$total;
        $account->history()->save($h);

        return redirect()->back()->with([
              'status'=>'success',
              'message'=>'Order deleted!'
        ]);
    }
}

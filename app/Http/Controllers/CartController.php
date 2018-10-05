<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\CartItem as Details;
use Auth;
use App\Product;
use App\Custom;

class CartController extends Controller
{  

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
      //with user auth
      $cart = Cart::where('user_id',Auth::id())->with('details')->first();

      return view('front.cart.cart',['cart'=> $cart]);
    }

    public function addToCart($id){
       
       $cart = Cart::where('user_id',Auth::id())->first();

        if($cart == null ){
         
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->save();
            $product = Product::findOrFail($id);
            $details = new Details();
            $details->quantity = 1;
            $details->product_id = $product->id;

            $cart->details()->save($details);
            return redirect(route('home'))
                       ->with(['status'=>'success','msg'=>'Added to cart']);

        }else{

            $cart = Cart::where('user_id',Auth::id())->with('details')->first();

            $detail = $cart->details()->where('product_id',$id)->with('product')->first();
            
            if($detail != null){

                 $detail = Details::findOrFail($detail->id);
                 $detail->quantity = $detail->quantity +1;
                 $detail->save();
                 return redirect(route('home'))
                       ->with(['status'=>'success','msg'=>'Added to cart']);
           
            }else{

                 $product = Product::findOrFail($id);
                 $detail = new Details();
                 $detail->quantity = 1;
                 $detail->product_id = $product->id;
                 $cart->details()->save($detail);
                 return redirect(route('home'))
                       ->with(['status'=>'success','msg'=>'Added to cart']);
            }
           
        }

    }

    public function addCartItem($id){

       $detail = Details::findOrFail($id);
       $detail->quantity +=1;
       $detail->save();
       
       return redirect(route('cart.view'))
                       ->with(['status'=>'success','msg'=>'successfully added cartItem']);
    }

    public function reduceCartItem($id){

       $detail = Details::findOrFail($id);
       

       if($detail->quantity == 1 ){
             
            $detail = Details::findOrFail($id);
            $detail->delete();

       }else{

            $detail->quantity -=1;
            $detail->save();

       }
       
       return redirect(route('cart.view'))
                       ->with(['status'=>'success','msg'=>'successfully reduced cartItem']);
    }

    public function deleteCartItem($id){

        $detail = Details::findOrFail($id);
        $detail->delete();

        return redirect(route('cart.view'))
                       ->with(['status'=>'success','msg'=>'successfully deleted cartItem']);
    }

    public function emptyCart(){
        $cart = Cart::where('user_id',Auth::id())->first();
        $cart->details()->delete();

       return redirect(route('cart.view'))->with(['status'=>'success','msg'=>'successfully Emptied cart']);
    }

    //custom

    public function addCustomToCart(Request $req){
        $req->validate([
          'dj'=>'required',
          'mc'=>'required',
          'tent'=>'required',
          'tentsize'=>'required'
        ]);
        $dj = $req->dj;
        $mc = $req->mc;
        $system = $req->system;
        $tent = $req->tent;
        $tent_size = $req->tentsize;
      
        $customcart = new Custom($dj,$mc,$system,$tent,$tent_size);
        $customcart = $customcart->getCustomCart();

        //cart
        $cart = Cart::where('user_id',Auth::id())->first();
        if($cart != null){

          $item = new Details();
          $item->product_id = 0;
          $item->custom = serialize($customcart);
          $cart->details()->save($item);

        }else{
          $cart = new Cart();
          $cart->user_id = Auth::id();
          $cart->save();

          $item = new Details();
          $item->product_id = 0;
          $item->custom = serialize($customcart);
          $cart->details()->save($item);
         
        }
        return redirect(route('home'))
                       ->with(['status'=>'success','msg'=>'successfully Added to cart']);
    }
    
}

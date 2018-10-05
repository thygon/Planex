<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Item;
use App\ProductDetails as Details;
use App\Cart;
use Auth;
use App\TentSizes;

class ProductController extends Controller
{
    

    public function products(){
       $products = Item::with('details')->get();
       return view('admin.premiums',['products'=>$products]);
    }

    public function index()
    {   
         //with user auth
        $cart = Cart::where('user_id',Auth::id())->with('details')->first();

        $products =  Item::with('details')->get();
        return view('front.home',['products'=> $products,'cart'=>$cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addpremium');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tentsize'=>'required'
        ]);
        $product = new Item();
        $product->title = $request->title;
        $product->slug = $request->title;
        $product->price = $request->prices;

        $details = new Details();
        $details->dj = $request->dj; 
        $details->mc = $request->mc; 
        $details->system = $request->system;
        $details->seat  = TentSizes::find($request->tentsize)->seats*$request->tent;
        $details->tent = $request->tent;
        $details->tent_size = $request->tentsize;
        $details->save();

        $details->product()->save($product);

        return redirect()->route('products')->with([
            'status'=>'success',
            'message'=>'Premium added!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

       return view('admin.editpremium',['premium'=>$item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tentsize'=>'required'
        ]);
        $product = Item::find($id);
        $product->title = $request->title;
        $product->slug = $request->title;
        $product->price = $request->prices;

        $details = $product->details()->first();
        $details->dj = $request->dj; 
        $details->mc = $request->mc; 
        $details->system = $request->system;
        $details->seat  = TentSizes::find($request->tentsize)->seats*$request->tent;
        $details->tent = $request->tent;
        $details->tent_size = $request->tentsize;
        $details->save();
        
        $product->save();

        return redirect()->route('products')->with([
            'status'=>'success',
            'message'=>'Premium updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $details = $item->details()->first();
        $item->delete();
        $details->delete();

        return redirect()->back()->with([
                'status'=>'success',
                'message'=>'Premium deleted!'
        ]);
    }
}

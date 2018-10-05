@extends('front.index')

@php $tl_price = 0; $tl_qty = 0;@endphp
@auth
	@if($cart)
	    @php
	     $tl_qty = $cart->details()->sum('quantity');
	     $tl_price = 0;
	    @endphp

	     @foreach($cart->details()->with('product')->get() as $item)
	       @php
	       if($item->product_id == 0){
             $tl_price += $item->custom['price']*$item->quantity;
	       }else{
             $tl_price += $item->product->price* $item->quantity;
	       }
	       @endphp
	     @endforeach

	@endif
@endauth

@section('content')
<div class="register">
		<h2>Checkout</h2>
		<span class="badge">Account: Ksh. {{($account != null  && $account->amount != 0)?$account->amount:0.00}}</span>
		{{$errors}}
		  	  <form action="{{route('order.cart')}}" method="post">
		  	  	{{csrf_field()}}
				 <div class="col-md-6  register-top-grid">
					
					<div class="mation">
						<span>Name</span>
						<input type="text" value="{{Auth::user()->firstname.' '.Auth::user()->lastname}}"> 
					 
						 <span>Address</span>
						 <input type="text" name="address" value="{{($user->profile)?$user->profile->address:''}}"> 
						 <span>Start Date</span>
						 <input type="date" name="from" value="{{old('from')}}">
						 <span>End Date</span>
						 <input type="date" name="to" value="{{old('to')}}">
					</div>
					 <div class="register-but"> </div>
					   <input type="submit" value="submit">
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>Total Ksh.</span>
								<input type="number" name="total" value="{{$tl_price}}">
								<span>Mpesa</span>
						        <input type="text" name="code" value="{{Old('code')}}"> 

						        <span>Payed amount</span>
						        <input type="number" name="amount" value="{{Old('amount')}}"> 
							</div>
					 </div>
					 <div class="clearfix"> </div>
				</form>
		   </div>

@endsection
@extends('front.index')

  @if($cart)
	  @php
	    $tl_qty = $cart->details()->sum('quantity');
	    $tl_price = 0;
	  @endphp
  @endif

@section('content')

@if($cart && $cart->details()->count() >= 1)
 <div class="check-out">
    <h2>Cart</h2>
          <table >
      <tr>
      <th>Item</th>
      <th>Qty</th>    
      <th>Prices</th>
      <th>Delivery details</th>
      <th>Sub total</th>
      <th></th>
      </tr>
      @foreach($cart->details()->with('product')->get() as $item)
      <tr>
      <td class="ring-in">
      <div>
        <h5>{{($item->product_id != 0 )? $item->product->title:'custom'}}</h5>
        @php
        if($item->product_id != 0){
         $details = $item->product()->with('details')->first();
        }else{
         $details = $item->custom;
        }
        @endphp
        @if($item->product_id != 0)
        <p>@php $details = $details->details()->first() @endphp
          dj:{{$details->dj}}| mc:{{$details->mc}}|system:{{$details->system}}|
           tent:{{$details->tent}}| seats:{{$details->seat}}
        </p>
        @else
        <p>dj: {{$details['dj']}} | mc: {{$details['mc']}} | tent: {{$details['tent']}}
      | seat: {{$details['seat']}} | system: {{$details['system']}} | tent-size: {{$details['tent_size']}}</p>
        @endif
      
      </div>
      <div class="clearfix"> </div></td>
      <td>
                          <span >
                            <a class="btn bg-primary" href="{{route('reduce.cart',['id'=> $item->id])}}" title="">-</a>
                          </span>
                          <span class="btn">{{$item->quantity}}</span>
                          <span >
                            <a class="btn bg-primary" href="{{route('add.cart',['id'=> $item->id])}}" title="">+</a>
                          </span>
                          
                          </td>  
      <td>Ksh. {{ ($item->product_id != 0)?$item->product->price* $item->quantity:
        $item->custom['price']*$item->quantity}}</td>
      <td>FREE SHIPPING</td>
      <td>Ksh. {{($item->product_id != 0)?$item->product->price* $item->quantity:
      $item->custom['price']*$item->quantity}}</td>
      <td>
        <span >
            <a class="btn bg-danger" href="{{route('remove.cart',['id'=> $item->id])}}" title="">delete</a>
        </span>
      </td>
      </tr>
      @endforeach
  </table>
  <a href="{{route('checkout.view')}}" class="to-buy">PROCEED TO ORDER</a>
  <div class="clearfix"> </div>
</div>
@else
<h4>Add items to cart <a href="{{route('home')}}">Shop</a></h4>
@endif

@endsection
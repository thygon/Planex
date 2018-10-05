@extends('front.index')


@section('content')

   @foreach($products as $product)
    <div class="col-md-3 animated wow fadeInLeft" data-wow-delay=".5s">
		<div class="col-md1 simpleCart_shelfItem">
			<h2 class="text-center">{{$product->title}}</h2>
			@php $detail = $product->details()->first();
                 $tentsize = $detail->tentSize()->first();
			 @endphp
			<ul class="list-group">
			  <li class="list-group-item">
			  	<h4 class="list-group-item-heading">Details</h4>
			  </li> 
			  <li class="list-group-item">Deejay: {{(!empty($detail->dj))?$detail->dj.' Djs': 'N/A'}}</li>
			  <li class="list-group-item">Mc: {{(!empty($detail->mc))?$detail->mc.' Mcs': 'N/A'}}</li>
			  <li class="list-group-item">Tent: {{(!empty($detail->tent))?$detail->tent.' Tents': 'N/A'}}   Size: 
			  	{{($tentsize != null)? $tentsize->size:'N/A'}}</li>
			  <li class="list-group-item">Seat: {{(!empty($detail->seat))?$detail->seat.' Seats': 'N/A'}}</li>
			  <li class="list-group-item">Sound System: {{(!empty($detail->system))?$detail->system.' Systems': 'N/A'}}</li>
			</ul>
			<div class="price">
				<h5 class="item_price">Ksh. {{$product->price}}</h5>
				<a href="{{ route('add.to.cart',['id'=>$product->id])}}" class="item_add">Add To Cart</a>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>	
	@endforeach

	<div class="col-md-3 animated wow fadeInLeft" data-wow-delay=".5s">
		<div class="col-md1 simpleCart_shelfItem">
			<h2 class="text-center">Custom</h2>
			<form action="{{route('custom.cart.add')}}" method="POST">
				{{csrf_field()}}
			<ul class="list-group">
			  <li class="list-group-item">
			  	<h5 class="list-group-item-heading">Make a custom Product</h5>
			  </li> 
			  <li class="list-group-item"><input type="number" min="0" name="dj" id="dj" placeholder="Djs"></li>
			  <li class="list-group-item"><input type="number" min="0" name="mc" id="mc" placeholder="Mcs"></li>
			  <li class="list-group-item"><input type="number" min="0" name="tent" id="tent" placeholder="Tents"></li>
			  <li class="list-group-item form-group">
				<select class="form-control" name="tentsize" required>
					<option>Select tent size</option>
					@foreach(\App\TentSizes::all() as $tz)
					   <option value="{{$tz->id}}">{{$tz->size}} : {{$tz->seats.'seats'}} </option>
					@endforeach
				</select>
			</li>
			  <li class="list-group-item"><input type="number" min="0" name="system" id="system" placeholder="systems"></li>
			</ul>
			<div class="price">
				<button type="submit" class="item_add">Add To Cart</button>
				<div class="clearfix"> </div>
			</div>
			</form>
		</div>
	</div>	
@endsection
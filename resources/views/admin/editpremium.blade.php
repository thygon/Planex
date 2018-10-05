@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">Edit Premium</div>
	<div class="panel-body">
		<form action="{{route('product.edit',['id'=>$premium->id])}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="title" value="{{$premium->title}}" required>
			</div>
			<div class="form-group">
				<label>DJ</label>
				<input class="form-control" type="number" name="dj" value="{{$premium->details()->first()->dj}}" required>
			</div>
			<div class="form-group">
				<label>Mc</label>
				<input class="form-control" type="number" name="mc" value="{{$premium->details()->first()->mc}}" required>
			</div>
			<div class="form-group">
				<label>tent</label>
				<input class="form-control" type="number" name="tent" value="{{$premium->details()->first()->tent}}" required>
			</div>
			<div class="form-group">
				@php $selected = $premium->details()->first()->tent_size;  @endphp
				<label>Tent Size</label>
				<select class="form-control" name="tentsize" required>
					<option disabled>Select tent size</option>
					@foreach(\App\TentSizes::all() as $tz)
					   <option value="{{$tz->id}}"   {{($selected == $tz->id)?'selected':''}} >{{$tz->size}} : {{$tz->seats.'seats'}} </option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>System</label>
				<input class="form-control" type="number" name="system" value="{{$premium->details()->first()->system}}" required>
			</div>
			<div class="form-group">
				<label>Price</label>
				<input class="form-control" type="number" name="prices" value="{{$premium->price}}"> 
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Update</button>
			</div>		
		</form>
	</div>
</div>

@endsection
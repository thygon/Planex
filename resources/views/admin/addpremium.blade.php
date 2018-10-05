@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">New Premium</div>
	<div class="panel-body">
		<form action="{{route('product.add')}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="title" required>
			</div>
			<div class="form-group">
				<label>DJ</label>
				<input class="form-control" type="number" name="dj" required>
			</div>
			<div class="form-group">
				<label>Mc</label>
				<input class="form-control" type="number" name="mc" required>
			</div>
			<div class="form-group">
				<label>tent</label>
				<input class="form-control" type="number" name="tent" required>
			</div>
			<div class="form-group">
				<label>Tent Size</label>
				<select class="form-control" name="tentsize" required>
					<option>Select tent size</option>
					@foreach(\App\TentSizes::all() as $tz)
					   <option value="{{$tz->id}}">{{$tz->size}} : {{$tz->seats.'seats'}} </option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>System</label>
				<input class="form-control" type="number" name="system" required>
			</div>
			<div class="form-group">
				<label>Price</label>
				<input class="form-control" type="number" name="prices"> 
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add new</button>
			</div>		
		</form>
	</div>
</div>

@endsection
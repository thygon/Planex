@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">New Tent Size</div>
	<div class="panel-body">
		{{$errors}}
		<form action="{{route('tentsize.add')}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label>Size</label>
				<input class="form-control" type="text" name="size">
			</div>
			<div class="form-group">
				<label>Number of seats</label>
				<input class="form-control" type="text" name="seats">
			</div>
			<div class="form-group">
				<label>Price</label>
				<input class="form-control" type="text" name="price">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add</button>
			</div>
		</form>
	</div>
</div>

@endsection
@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">New Product</div>
	<div class="panel-body">
		{{$errors}}
		<form action="{{route('item.add')}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label>name</label>
				<input class="form-control" type="text" name="name" required>
			</div>
			<div class="form-group">
				<label>Number of available</label>
				<input class="form-control" type="text" name="total" required>
			</div>
			<div class="form-group">
				<label>Price each</label>
				<input class="form-control" type="text" name="price" requireds>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add Product</button>
			</div>
		</form>
	</div>
</div>

@endsection
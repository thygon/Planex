@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">New Product</div>
	<div class="panel-body">
		{{$errors}}
		<form action="{{route('item.edit',['id'=>$item->id])}}" method="post">
			{{csrf_field()}}
			<div class="form-group">s
				<label>name</label>
				<input class="form-control" type="text" name="name" value="{{$item->name}}" required>
			</div>
			<div class="form-group">
				<label>Number of available</label>
				<input class="form-control" type="text" name="total" value="{{$item->total}}" required>
			</div>
			<div class="form-group">
				<label>Price each</label>
				<input class="form-control" type="text" name="price" value="{{$item->price}}" requireds>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Update Product</button>
			</div>
		</form>
	</div>
</div>

@endsection
@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">Edit Tent Size</div>
	<div class="panel-body">
		{{$errors}}
		<form action="{{route('tentsize.edit',['id'=>$size->id])}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label>Size</label>
				<input class="form-control" type="text" name="size" value="{{$size->size}}">
			</div>
			<div class="form-group">
				<label>Number of seats</label>
				<input class="form-control" type="text" name="seats" value="{{$size->seats}}">
			</div>
			<div class="form-group">
				<label>Price</label>
				<input class="form-control" type="text" name="price" value="{{$size->price}}">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</form>
	</div>
</div>

@endsection
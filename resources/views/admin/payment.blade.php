@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">Payments</div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Total in stock</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($payments as $i)
				{{$i}}
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
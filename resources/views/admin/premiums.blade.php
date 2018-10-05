@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">Premiums</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTables-premium" >
			<thead>
				<tr>
					<th>Tile</th>
					<th>Details</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{$product->title}}</td>
					<td>
						@php $detail = $product->details()->first();@endphp
						<p>
							dj:{{$detail->dj}}
							mc:{{$detail->mc}}
							system:{{$detail->system}}
							tent:{{$detail->tent}}
							seat:{{$detail->seat}}
						</p>
						<p>
							Tent size:{{$detail->tentSize()->first()->size}},{{$detail->tentSize()->first()->seats}} seats
						</p>
					</td>
					<td>{{$product->price}}</td>
					<td>
						<a href="{{route('product.show',['id'=>$product->id])}}" class="btn btn-warning" >Edit</a>
						<a href="{{ route('product.delete',['id'=>$product->id]) }}" onclick="event.preventDefault();
                            document.getElementById('premium-delete-form').submit();" class="btn btn-success" >Delete</a>
						<form id="premium-delete-form" action="{{ route('product.delete',['id'=>$product->id]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                        </form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection

@section('scripting')

<script>
	
	 $(document).ready(function(){
            $('.dataTables-premium').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Event Planning Premiums'},
                    {extend: 'pdf', title: 'Event Planning Premiums'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
</script>
@endsection
@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">Tent Sizes</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTables-orders" >
			<thead>
				<tr>
					<th>Size</th>
					<th>Seats</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($sizes as $size)
				<tr>
					<td>{{$size->size}}</td>
					<td>{{$size->seats}}</td>
					<td>{{$size->price}}</td>
					<td><a href="{{route('tentsize.show',['id'=>$size->id])}}" class="btn btn-warning">Edit</a>
						<a href="{{ route('tentsize.delete',['id'=>$size->id]) }}" onclick="event.preventDefault();
                            document.getElementById('size-delete-form').submit();" class="btn btn-success" >Delete</a>
						<form id="size-delete-form" action="{{ route('tentsize.delete',['id'=>$size->id]) }}" method="POST" style="display: none;">
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
            $('.dataTables-orders').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Event Planning Tent Sizes'},
                    {extend: 'pdf', title: 'Event Planning Tent Sizes'},

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
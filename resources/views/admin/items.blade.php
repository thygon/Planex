@extends('admin.main.main')

@section('content')

<div class="panel">
	<div class="panel-heading">Products</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-hover dataTables-orders" >
			<thead>
				<tr>
					<th>Name</th>
					<th>Total in stock</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $i)
				<tr>
					<td>{{$i->name}}</td>
					<td>{{$i->total}}</td>
					<td>{{$i->price}}</td>
					<td><a href="{{route('item.show',['id'=>$i->id])}}" class="btn btn-warning">Edit</a>
						<a href="{{ route('item.delete',['id'=>$i->id]) }}" onclick="event.preventDefault();
                            document.getElementById('item-delete-form').submit();" class="btn btn-success" >Delete</a>
						<form id="item-delete-form" action="{{ route('item.delete',['id'=>$i->id]) }}" method="POST" style="display: none;">
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
                    {extend: 'excel', title: 'Event Planning Products'},
                    {extend: 'pdf', title: 'Event Planning Products'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            $(win.document.body).find('table a')
                                    .css('display', 'none');
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
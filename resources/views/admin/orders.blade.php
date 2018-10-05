@extends('admin.main.main')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">Orders</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover dataTables-orders" >
						<thead>
							<tr>
								<th>Details</th>
								<th>Address</th>
								<th>Dates</th>
								<th>Status</th>
								<th>actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order)
							<tr>
								<td>
									@php $details = $order->cart->details; @endphp
									@foreach($details as $detail)
									   @if($detail->product_id == 0 )
                                          dj:{{$detail->custom['dj']}},Mc :{{$detail->custom['mc']}},
                                           Seats:{{$detail->custom['seat']}}, tents:{{$detail->custom['tent']}}, Size:{{$detail->custom['tent_size']}},
                                            systems:{{$detail->custom['system']}}
                                           <p>Quanitity:{{$detail->quantity}}</p>
									   @else
                                          @php $product= $detail->product()->first();  @endphp
                                          <p>{{$product->title}}</p>
                                          <p>Quantity:{{$detail->quantity}}</p>
									   @endif
									@endforeach
								</td>
								<td>{{$order->address}}</td>
								
								<td>
									From:{{$order->from}} To: {{$order->to}}
								</td>
								<td>
									@if($order->status == 1 )
									Pending confirmation
									@elseif($order->status == 3 )
									Shipping
									@elseif($order->status == 4 )
									pending shipping
									@elseif($order->status == 5 )
									rejected
									@elseif($order->status == 6 )
									Delivery confirmation
									<p>
										Comment: {{$order->comments()->latest()->first()->comment}}
									</p>
									@endif

								</td>
								<td>
									@if($order->status == 1 )
									<a href="{{route('confirm',['id'=>$order->id]) }}" onclick="event.preventDefault();
			                            document.getElementById('confirm-form').submit();" class="btn btn-success">Confirm</a>
									<a href="{{ route('reject',['id'=>$order->id]) }}" onclick="event.preventDefault();
			                            document.getElementById('reject-form').submit();" class="btn btn-warning">Reject</a>
			                        @elseif($order->status == 4)

			                        <a href="{{ route('ship',['id'=>$order->id]) }}" onclick="event.preventDefault();
			                            document.getElementById('shipping-form').submit();" class="btn btn-warning">Ship</a>
			                       
			                        <a href="{{ route('reject',['id'=>$order->id]) }}" onclick="event.preventDefault();
			                            document.getElementById('reject-form').submit();" class="btn btn-warning">Reject</a>
			                        @elseif($order->status == 5)

			                        <a href="{{route('confirm',['id'=>$order->id]) }}" onclick="event.preventDefault();
			                            document.getElementById('confirm-form').submit();" class="btn btn-success">Confirm</a>


			                        @endif

									<form id="confirm-form" action="{{ route('confirm',['id'=>$order->id]) }}" method="POST" style="display: none;">
			                                            {{ csrf_field() }}
			                        </form>
			                        <form id="reject-form" action="{{ route('reject',['id'=>$order->id]) }}" method="POST" style="display: none;">
			                                            {{ csrf_field() }}
			                        </form>

			                        <form id="shipping-form" action="{{ route('ship',['id'=>$order->id]) }}" method="POST" style="display: none;">
			                                            {{ csrf_field() }}
			                        </form>
								</td>				
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
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
                    {extend: 'excel', title: 'Event Planning Orders'},
                    {extend: 'pdf', title: 'Event Planning Orders'},

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
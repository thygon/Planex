@extends('front.index')

@section('content')

<table class="table">
	<caption><h1>My Orders</h1></caption>
	<thead>
		<tr>
			<th>Details</th>
      <th>Dates</th>
			<th>Order cost</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $order)
		<tr>
			<td>
				 @foreach($order->cart->details as $details)
           @if($details->product_id == 0 )
                     @php
                     $custom = $details->custom;
                     @endphp
                     Dj:{{$custom['dj']}},
                     Mc:{{$custom['mc']}},
                     Seats:{{$custom['seat']}},
                     Systems:{{$custom['system']}},
                     Tents:{{$custom['tent']}}
                     Tent Size:{{$custom['tent_size']}}
          @else

          @php $product= $details->product()->first();  @endphp
          {{$product->title}}
          <p>Quantity:{{$details->quantity}}</p>
          @endif

        @endforeach
			</td>
      <td>
        From: {{$order->from}} |
        To: {{$order->to}}
      </td>
		    <td>
		    	@if($order->cart->product_id != 0)
                   {{'normal'}}
		    	@else
                  @foreach($order->cart->details as $details)
                  @if($details->product_id == 0 )
                     @php
                     $custom = $details->custom;
                     @endphp
                     Total:Ksh {{$custom['price']}}
                  @else
                    @php $product= $details->product()->first();  @endphp
                    Total:Ksh {{$product->price}}
                  @endif
                  @endforeach
		    	@endif
		    </td>
		    <td>@if($order->status == 1 )
                  Pending confirmation
                  @elseif($order->status == 3 )
                  Shipping
                  @elseif($order->status == 4 )
                  pending shipping
                  @elseif($order->status == 5 )
                  rejected
                   @elseif($order->status == 6 )
                  recieved
                  <p>
                    Comment: {{$order->comments()->latest()->first()->comment}}
                  </p>
                  @endif</td>
		    <td>
          <div class="btns-group">
              @if($order->status == 3 )
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-getter="{{$order->id}}" data-action="confirm/order">Confirm Delivery</button>
                 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-getter="{{$order->id}}" data-action="reject/order">Reject Delivery</button>
              @elseif($order->status == 1 || $order->status == 2 || $order->status == 4 || $order->status == 5 )
               
                <span><a class="btn btn-danger" href="{{route('delete.order',['id'=>$order->id])}}">Delete</a></span>
              @endif
          </div>
		    </td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('comment.order')}}">
        	{{csrf_field()}}
        	<input id="getter" type="hidden" name="getter">
          <div class="form-group">
            <label for="message-text" class="form-control-label">Comment:</label>
            <textarea class="form-control" name="comment" placeholder="your comment" id="message-text" required></textarea>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send comment</button>
         </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('getter') // Extract info from data-* attributes
		  var action = button.data('action')
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  $.post(action+'/'+recipient,{'_token':'<?=csrf_token();?>'},function(s){
             console.log(s);
		  });
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Comment why '+ action)
		  modal.find('.modal-body input#getter').val(recipient)

	});
</script>

@endsection

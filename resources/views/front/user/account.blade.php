@extends('front.index')

@section('content')
<h1>Account</h1>

<div class="row">
	@if($account != null)
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-body"><h2>Acc balance: Ksh {{$account->amount}}</h2></div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">Acc history</div>
			<div class="panel-body">
				@foreach($account->history as $history)
                   <p>
                   	{{$history->description}} | Account bal. {{$history->account['amount']}} |  {{$history->created_at}}
                   </p>
				@endforeach
			</div>
		</div>
	</div>
	@else
		<h1>Deposit to create an account</h1>
	@endif
</div>

@endsection
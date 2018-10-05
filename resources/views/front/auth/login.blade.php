@extends('front.index')

@section('content')
<div class="account">
	<div class="conta">
		<h2>Account</h2>
		<div class="account_grid">
			   <div class="col-md-6 login-right">
				<form action="{{route('login')}}" method="post">
                   {{csrf_field()}}

                    @if ($errors->has('email') || $errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:red;">All fields are required!</strong>
                                    </span>
                     @endif

					<span>Email Address</span>
					<input type="text" name="email" value="{{ old('email') }}"> 
					 @if ($errors->has('email') && !$errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                    </span>
                     @endif
				
					<span>Password</span>
					<input type="password" name="password"> 
					<div class="word-in">
				  		<a class="forgot" href="#">Forgot Your Password?</a>
				 		 <input type="submit" value="Login">
				  	</div>
			    </form>
			   </div>	
			    <div class="col-md-6 login-left">
			  	 <h4>NEW CUSTOMERS</h4>
				 <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
				 <a class="acount-btn" href="{{route('register')}}">Create an Account</a>
			   </div>
			   <div class="clearfix"> </div>
			 </div>
	</div>
</div>
@endsection

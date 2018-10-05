@extends('front.index')

@section('content')
 <div class="register">
		<h2>Register</h2>
		  	  <form action="{{route('register')}}" method="post">
					{{csrf_field()}}
				 <div class="col-md-6  register-top-grid">
					<div class="mation">
						<span>First Name</span>
						<input type="text" name="firstname" required> 
					
						<span>Last Name</span>
						<input type="text" name="lastname"> 
					 
						 <span>Email Address</span>
						 <input type="text" name="email" required> 
					</div>
					 <div class="clearfix"> </div>
					 <div class="register-but">
					   <input type="submit" value="submit">
					</div>
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>Password</span>
								<input type="password" name="password" required>
								<span>Confirm Password</span>
								<input type="password" name="password_confirmation" required>
							</div>
					 </div>
					 <div class="clearfix"> </div>
				</form>
		   </div>
@endsection
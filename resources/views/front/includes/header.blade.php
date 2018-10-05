@php $tl_price = 0; $tl_qty = 0; @endphp
@auth
	@if($cart)
	    @php
	    $tl_qty = $cart->details()->sum('quantity');
	     $tl_price = 0;

	    @endphp
		
		@foreach($cart->details as $cart)
		    @if($cart->product_id != 0)
	         @php
	            $tl_price += $cart->product->price* $cart->quantity;
	          @endphp
	        @else
	         @php
	           $tl_price += $cart->custom['price']*$cart->quantity;
	         @endphp
	        @endif
		 @endforeach
	@endif
@endauth

<!--header-->
<div class="header">
	<div class="header-top">
		<div class="container">
				<div class="col-sm-4 logo animated wow fadeInLeft" data-wow-delay=".5s">
					<h1><a href="{{ route('home')}}">Event <span>Planning</span></a></h1>	
				</div>
			<div class="col-sm-4 world animated wow fadeInRight" data-wow-delay=".5s">
					<div class="cart box_1">
						
						<a href="{{route('cart.view')}}">
						<h3> <div class="total">
							<span>{{($tl_price)? 'Ksh. '.$tl_price:'Ksh 0.00'}}</span></div>
							<img src="images/cart.png" alt=""/>
							<span class="badge">{{($tl_qty)? $tl_qty:''}}</span></h3>
						</a>
						<p><a href="{{route('cart.empty')}}"
							onclick="event.preventDefault();
                            document.getElementById('empty-form').submit();">Empty Cart
                            </a>
                            <form id="empty-form" action="{{ route('cart.empty') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                        </p>

					</div>
					
			</div>
			<div class="col-sm-2 number animated wow fadeInRight" data-wow-delay=".5s">
					<span><i class="glyphicon glyphicon-phone"></i>085 596 234</span>
					<p>Call me</p>
				</div>
			<div class="col-sm-2 search animated wow fadeInRight" data-wow-delay=".5s">		
				<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
		<div class="container">
			<div class="head-top">
			<div class="n-avigation">
			
				<nav class="navbar nav_bottom" role="navigation">
				
				 <!-- Brand and toggle get grouped for better mobile display -->
				  <div class="navbar-header nav_2">
					  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="#"></a>
				   </div> 
				   <!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav nav_1">
							<li><a href="{{route('home')}}">Home</a></li>							
							<li><a href="{{url('/')}}">Products</a></li>
							@guest
							<li><a href="{{route('login')}}">Sign In</a></li>
							@else
							<li><a href="{{route('my.orders')}}">My Orders <span class="badge">
								{{ Auth::user()->orders()->where('status','!=',6)->count()}}
							</span></a>
							</li>
							<li class="dropdown mega-dropdown active">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->firstname }}<span class="caret"></span></a>				
								<div class="dropdown-menu" style="padding: 10px 10px;">
									<ul>
										<li>
											<a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                                        <li><a href="{{route('profile')}}">Profile</a></li>
                                        <li><a href="{{route('account')}}">Account</a></li>
									</ul>
                                        
								</div>				
							</li>
							@if(Auth::user()->isadmin())
							<li><a href="{{ route('admin')}}">Dashboard</a></li>
							@endif
							@endguest
							<li class="last"><a href="{{ route('contact')}}">Contact</a></li>

						</ul>
					 </div><!-- /.navbar-collapse -->
				  
				</nav>
			</div>
			
				
		<div class="clearfix"> </div>
			<!---pop-up-box---->   
					<link href="{{ asset('css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all"/>
					<script src="{{ asset('js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
					<!---//pop-up-box---->
				<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
						<div class="login">
							<form action="#" method="post">
								<input type="submit" value="">
								<input type="text" name="search" value="Type something..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">		
							
							</form>
						</div>
						<p>	Shopping</p>
					</div>				
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>			
	<!---->		
		</div>
	</div>
</div>


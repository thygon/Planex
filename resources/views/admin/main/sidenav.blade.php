<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" id="cbp-spmenu-s1">
					<div class="scrollbar scrollbar1">
						<ul class="nav" id="side-menu">
							<li>
								<a href="{{route('admin')}}" ><i class="fa fa-home nav_icon"></i>Dashboard</a>
							</li>
							<li>
								<a href="{{route('orders')}}"><i class="fa fa-book nav_icon"></i>Orders </a>
							</li>
							<li>
								<a href="#"><i class="fa fa-book nav_icon"></i>Premiums <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="{{route('products')}}"> All Premiums</a>
									</li>
									<li>
										<a href="{{route('create.product.form')}}">New Premium</a>
									</li>
								</ul>
								<!-- /nav-second-level -->
							</li>
							<li>
								<a href="{{route('payments')}}"><i class="fa fa-dollar nav_icon"></i>Payments</a>
							</li>
							
							<li>
								<a href="#"><i class="fa fa-th-large nav_icon"></i>Tent Sizes<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="{{route('tentsizes')}}">Tent Sizes</a>
									</li>
									<li>
										<a href="{{route('create.tentsize.form')}}">New Tent Size</a>
									</li>
								</ul>
								<!-- //nav-second-level -->
							</li>
							<li>
								<a href="#"><i class="fa fa-envelope nav_icon"></i>Products<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="{{route('items')}}">All Products</a>
									</li>
									<li>
										<a href="{{route('create.item.form')}}">New Product</a>
									</li>
								</ul>
								<!-- //nav-second-level -->
							</li>
							
							<li>
								<a href="#"><i class="fa fa-gears nav_icon"></i>Settings<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									
									<li>
										<a href="signup.html">Profile</a>
									</li>
									<li>
											<a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
							</li>
						</ul>
					</div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
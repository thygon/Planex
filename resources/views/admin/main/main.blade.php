<!DOCTYPE HTML>
<html>
<head>
<title>Event Planning</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Baxster Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('brax/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{ asset('brax/css/style.css')}}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link rel="icon" href="favicon.ico" type="image/x-icon" >
<!-- font-awesome icons -->
<link href="{{ asset('brax/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->

 <!-- js-->
<script src="{{ asset('brax/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset('brax/js/modernizr.custom.js')}}"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="{{ asset('css/animate.min.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{ asset('brax/js/wow.min.js')}}"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="{{ asset('brax/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('brax/js/custom.js')}}"></script>
<link href="{{ asset('brax/css/custom.css')}}" rel="stylesheet">
<link href="{{ asset('brax/css/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('toastr/toastr.min.css')}}" rel="stylesheet"> 

<style>

.html5buttons {
    float: right;
}
.dataTables_length {
    float: left;
}
	
</style>
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		@include('admin.main.sidenav')
		@include('admin.main.header')
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
		@yield('content')
			</div>
		</div>
	</div>
	<script src="{{ asset('brax/js/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- Bootstrap Core JavaScript --> 
		
        <script type="text/javascript" src="{{ asset('brax/js/bootstrap.min.js')}}"></script>
        <link href="{{ asset('brax/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
        <script src="{{ asset('toastr/toastr.min.js')}}"></script>
        @if(Session::has('status'))
        <script>
        var status = '{{Session::get('status')}}';

        switch(status){
            case 'success':
              toastr.success('{{Session::get('message')}}','success');
              break;
            case 'error':
              toastr.warning('{{Session::get('message')}}','error');
              break;
            case 'info':
              toastr.info('{{Session::get('message')}}');
              break;
		        }

		</script>
		@endif
        <!--scrolling js-->
		<script src="{{ asset('brax/js/jquery.nicescroll.js')}}"></script>
		<script src="{{ asset('brax/js/scripts.js')}}"></script>
		<script src="{{ asset('brax/js/datatables.min.js')}}"></script>

		<!--//scrolling js-->
		@yield('scripting')
</body>
</html>
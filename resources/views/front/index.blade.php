<!DOCTYPE html>
<html>
<head>
<title>Event Planning</title>
<link href="{{ asset('css/app.css')}}" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/app.js')}}"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Youth Fashion Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<script src="{{ asset('js/simpleCart.min.js')}}"> </script>
<!-- slide -->
<script src="{{ asset('js/responsiveslides.min.js')}}"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: false,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
  <!-- animation-effect -->
<link href="{{ asset('css/animate.min.css')}}" rel="stylesheet"> 
<link href="{{ asset('toastr/toastr.min.css')}}" rel="stylesheet"> 
<script src="{{ asset('toastr/toastr.min.js')}}"></script>
<script src="{{ asset('js/wow.min.js')}}"></script>
<script>
 new WOW().init();
</script>
<!-- //animation-effect -->
</head>
<body>
  @include('front.includes.header')
  <!--content-->
  <div class="content">
    <div class="container">
      <div class="content-top">
        <div class="content-top1">
          @yield('content')
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  @include('front.includes.footer')
  @if($errors) 
    @if($errors->has('dj'))
    <script> toastr.warning("{{$errors->first('dj')}}",'error')</script>
    @endif
    @if($errors->has('mc'))
    <script> toastr.warning("{{$errors->first('mc')}}",'error')</script>
    @endif
    @if($errors->has('system'))
    <script> toastr.warning("{{$errors->first('system')}}",'error')</script>
    @endif
    @if($errors->has('tent'))
    <script> toastr.warning("{{$errors->first('tent')}}",'error')</script>
    @endif
    @if($errors->has('tentsize'))
    <script> toastr.warning("{{$errors->first('tentsize')}}",'error')</script>
    @endif
  @endif
<script>
        var status = '{{Session::get('status')}}';

        switch(status){
            case 'success':
              toastr.success('{{Session::get('msg')}}','success');
              break;
            case 'error':
              toastr.warning('{{Session::get('msg')}}','error');
              break;
            case 'info':
              toastr.info('{{Session::get('msg')}}');
              break;
        }

</script>
</body>
</html>
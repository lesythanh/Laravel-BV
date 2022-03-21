<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">

</head><!--/head-->

<body>
{{-- header --}}

@include('frontend.layouts.header')
	
{{-- slide --}}
	@include('frontend.layouts.slide')
	<section>
		<div class="container">
            <?php  
            $curPageName = basename($_SERVER['REQUEST_URI']);    
            // echo $curPageName;
          ?>  
                          {{-- @if ($curPageName)
                @include('frontend.layouts.menu-left-account');
              @endif --}}
			<div class="row">
 

           
              {{-- @if ($curPageName == null) --}}
              @include('frontend.layouts.menu-left')
              {{-- @endif --}}


				
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
@include('frontend.layouts.footer')
	

  
    <script src="{{ asset('frontend/js/jquery.js')}}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('frontend/js/price-range.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('frontend/js/main.js')}}"></script>
   
    
<script>
        $(document).on('click', '.add-to-cart', function () {
      var getId = $(this).closest("div.single-products").find("p.id").text();
      var _token = $('input[name="_token"]').val()
      console.log(getId);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url:"{{ url('/addtocart') }}", 
        method:"POST", 
        data:{
          product_id:getId, 
          _token:_token,
        },
        success:function(data){ 
      //   $('a.qty').text(data)
        console.log(data);
        }
      })
    })
</script>
</body>

</html>
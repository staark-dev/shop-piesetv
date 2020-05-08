<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="max-age=604800">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="AdsBot-Google" content="noindex" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }}</title>
    <meta name="msvalidate.01" content="B28FD7C549D0803D9B6C61176013B81F" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font awesome 5 -->
    <script src="https://kit.fontawesome.com/b2680ca368.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/stylecheet.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" media="only screen and (max-width: 1200px)">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
        @yield('add_style');
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.partials.header')

        @yield('navigation')
        <div>

        @yield('header-banner')

        @yield('content')
        
        <div class="scroller" style="margin-left: 50%">
			<button onclick="topFunction()" id="myBtn" class="btn btn-light" title="Go to top" style="border: none;width:50px;text-align:center"><i class="fa fa-arrow-circle-up" style="font-size:30px;"></i></button>
				
				<script>
				
				var mybutton = document.getElementById("myBtn");
				
				window.onscroll = function() {scrollFunction()};
				
				function scrollFunction() {
				  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					mybutton.style.display = "block";
				  } else {
					mybutton.style.display = "none";
				  }
				}
				function topFunction() {
				  document.body.scrollTop = 0;
				  document.documentElement.scrollTop = 0;
				}
				</script>
                </div>
                
        @include('layouts.partials.footer')
    </div>
</body>
</html>
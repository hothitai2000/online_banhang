<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel </title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{URL::to('source/assets/dest/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/assets/dest/vendors/colorbox/example3/colorbox.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/assets/dest/rs-plugin/css/settings.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/assets/dest/rs-plugin/css/responsive.css')}}">
	<link rel="stylesheet" title="style" href="{{URL::to('source/assets/dest/css/style.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/assets/dest/css/animate.css')}}">
	<link rel="stylesheet" title="style" href="{{URL::to('source/assets/dest/css/huong-style.css') }}">

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body>

	@include('header')
	<div class="rev-slider">
        @yield('content')
	</div> <!-- .container -->

	@include('footer')

    @include('script')
</body>
</html>

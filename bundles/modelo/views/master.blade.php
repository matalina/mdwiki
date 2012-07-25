<!DOCTYPE html>

<!--[if IE 7]><html class="no-js ie7 oldie" lang="{{ Modelo::get('language') }}"> <![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="{{ Modelo::get('language') }}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{{ Modelo::get('language') }}"> <!--<![endif]-->

<head>
	@include('modelo::head')
</head>

<body class="@yield('tags')">

	@if (View::exists('common.header'))
		@include('common.header')
	@endif


	<div id="main">
		@yield('content')
	</div>

  
	@if (View::exists('common.footer'))
		@include('common.footer')
	@endif


	@include('modelo::tail')

</body>
</html>
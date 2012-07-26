@section('head')

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>@yield('title') | Markdown Wiki</title>
	<meta name="description" content="@yield('description')">
	<meta name="author" content="{{ Modelo::get('author') }}">

	{{-- In case you want to add you own meta tags --}}
	@yield('meta')

	{{-- Mobile viewport optimized: j.mp/bplateviewport --}}
	<meta name="viewport" content="width=device-width,initial-scale=1">
		
	{{-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading --}}
	<meta http-equiv="cleartype" content="on">

	
	{{-- Don't forget your favicons! Place them in your root directory --}}


	{{-- Direct search spiders to the sitemap and the author's information --}}
	<link rel="sitemap" type="application/xml" title="Sitemap" href="{{ URL::to_asset('sitemap.xml') }}">
	<link rel="author" title="Author" href="{{ URL::to_asset('humans.txt') }}">



	{{-- ===== CSS ===== --}}
	{{ Basset::show('foundation.css') }}
  <style>
    a:not([href*="{{ URL::base() }}"]):before { content: 'l '; font-family: 'FoundationIconsGeneral'; }
  </style>


	{{-- ===== JS ===== --}}
	@section('scripts')
		<script src="{{ URL::to_asset('bundles/modelo/polyfills.min.js') }}"></script>
	@yield_section
	{{-- More Javascript at the bottom for faster web performance --}}

@yield_section
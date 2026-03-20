@php
	$generalSetting = cache()->remember('general_setting', 3600, fn() => \App\Models\GeneralSetting::first());
	$seoSetting = cache()->remember('seo_setting', 3600, fn() => \App\Models\SeoSetting::first());
@endphp

<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{@$seoSetting->description}}">
	<meta name="keywords" content="{{@$seoSetting->keywords}}">
	<title>{{@$seoSetting->title}}</title>
	<link rel="shortcut icon" type="image/ico" href="{{asset($generalSetting?->favicon)}}" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Poppins:400,700,800&display=swap">
	<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/assets/css/normalize.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/assets/css/style-plugin-collection.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/assets/css/theme.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/assets/css/toastr.min.css')}}">
</head>

<body>
	<div class="preloader">
		<div class="preloader-inner">
			<svg class="preloader-ring" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
				<circle class="preloader-ring-bg" cx="50" cy="50" r="42"/>
				<circle class="preloader-ring-fill" cx="50" cy="50" r="42"/>
			</svg>
		</div>
	</div>

    @include('frontend.layouts.navbar')

	<div class="main_wrapper" data-bs-spy="scroll" data-bs-target="#main_menu_area" data-bs-root-margin="0px 0px -40%"
		data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary" tabindex="0">

		@yield('content')

        @include('frontend.layouts.footer')

	</div>


	<script src="{{asset('frontend/assets/js/vendor/jquery-min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}" defer></script>
	<script src="{{asset('frontend/assets/js/jquery-plugin-collection.js')}}" defer></script>
	<script src="{{asset('frontend/assets/js/toastr.min.js')}}" defer></script>
	<script src="{{asset('frontend/assets/js/vendor/modernizr.js')}}" defer></script>
	<script src="{{asset('frontend/assets/js/main.js')}}" defer></script>
	<script src="{{asset('frontend/assets/js/lang-switch.js')}}" defer></script>
	@stack('scripts')
</body>

</html>

<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<title>@yield('title')</title>
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/css/jquery.datetimepicker.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/css/customcss.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/css/dashboard.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/main.css') }}"></link>
 <script src="{{ asset('bootstrap/js/jquery.datetimepicker.full.js') }}"></script>
 </head>

<body>
	<div class="display-table">
		<div class="display-table-row">
			@if(Auth::user()->hasRole('Admin'))
				@include('includes.adminNav1')
				<div class="col-md-10 container-fluid marginNone display-table-cell">
						@include('includes.adminNav2')

			@elseif(Auth::user()->hasRole('User'))
				@include('includes.userNav1')
				<div class="col-md-10 container-fluid marginNone display-table-cell">
						@include('includes.userNav2')
			@endif
					@include('includes.message')
					@section('body')
					@show
					<!-- content goes here -->
				</div>
		</div>
	</div>

</body>
</html>

@section('datepicker')
@show
 <script src="{{ asset('bootstrap/jquery2.1.4.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/jquery-migrate-1.2.1.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ URL::to('bootstrap/js/myjs.js') }}"></script>
 
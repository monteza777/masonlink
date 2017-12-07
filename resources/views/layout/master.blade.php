<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
	@include('partials._header')
 </head>
<body>
	<div class="display-table">
		<div class="display-table-row">
			@if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Author') )
				@include('includes.adminNav1')
				<div class="col-md-10 container-fluid marginNone display-table-cell">
						@include('includes.adminNav2')
			@elseif(Auth::user()->hasRole('District Secretary'))
				@include('includes.secNav1')
				<div class="col-md-10 container-fluid marginNone display-table-cell">
						@include('includes.secNav2')

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
<script src="{{ URL::to('bootstrap/js/myjs.js') }}"></script>
</body>
</html>

@section('datepicker')
@show
 
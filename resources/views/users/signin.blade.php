@extends('layout.master')
@section('title','Sign In | Home')
@section('activesignIn','active')

@section('body')
<div class="container-fluid">
<div class="row">
</div>
</div>
<div class="col-md-12 col-lg-12 col-sm-12">
<div class="text-center">
<div class="col-md-7 col-md-offset-2">
	<form class="form-group">
		<label>Username: </label>
		<input type="text" class="form-control" placeholder="Username"><br>
		<label>Password: </label>
		<input type="password" class="form-control" placeholder="Password"><br>
		<center>
		@can('update-post', $user)
		<button class="btn btn-primary">Sign-In</button>
		@endcan
		</center>
	</form>
</div>
</div>
@endsection	
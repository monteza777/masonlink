@extends('layout.master')
@section('title','MasonLink | Home')
@section('activeHome','active')

@section('body')

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="well">
<!-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> -->
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<div class="row text-center">
<form action="{{ route('submit') }}" method="post">
			<div class="form-group">
			<label for="input">Financial Report</label>
			<textarea class="form-control" name="content" id="input" rows="10"></textarea>
			</div>
			{{csrf_field()}}
			<button type="submit" class=" btn btn-primary">Submit</button>
		</form>
</div>

</div>
</div>
</div>
</div>
@include('includes.scripteditor')
@endsection

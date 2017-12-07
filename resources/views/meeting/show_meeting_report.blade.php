@extends('layout.master')
@section('title','MasonLink | Meeting Report')
@section('activeHome','active')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<!-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> -->
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="col-md-5">
	<table class="table table-responsive">
	<tbody>
		<thead>
			<th>Title</th>
			<th>Content</th>
		</thead>
</div> <!-- div for col-md-6 for HEADER -->
<div class="col-md-7">
		<tr>
			<td>{!!$showReport->report_title!!}</td>
			<td>{!!$showReport->report_content!!}</td>
		</tr>
</div>
</tbody>
</table>
	@if($showReport->official == 1)
	  <a href="{{route('meetingControllerOr')}}" class="btn btn-success">Back</a></center>
	  @else
	  <a href="{{route('meetingController')}}" class="btn btn-success">Back</a></center>
	@endif
</div>		
</div>
</div>
@endsection

@extends('layout.master')
@section('title','MasonLink | Create Financial Report')
@section('activeHome','active')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<!-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> -->
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<h2 class="alert-warning">CREATE UNOFFICIAL FINANCIAL REPORT</h2>
<label for="input">Financial Report</label>
<div class="well">
<form action="{{ route('finanReportUoStore') }}" method="post">
			<input type="text" class="form-control" name="report_title" placeholder="Title" value="{{old('report_title')}}" required><br>
			<input type="hidden" name="id" value="">
			<textarea class="form-control" name="report_content" id="input" rows="10" value="1"></textarea>
			</div>
			{{csrf_field()}}
			<center><button type="submit" class=" btn btn-primary">Submit</button>
			<a href="{{ route('finanUoIndex') }}" class="btn btn-success">Back</a></center>
		</form>

</div>
</div>
</div>
</div>
@include('includes.scripteditor')
@endsection

@extends('layout.master')
@section('title','MasonLink | Edit Report')
@section('activeHome','active')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<label for="input">Update Meeting Report</label>
<div class="well">
<form action="/meeting/{{$mReport->id}}/update" method="post">
 {{csrf_field()}}
 {{method_field('PUT')}}
      <input type="text" class="form-control" name="rTitle"  value="{{$mReport->report_title}}" required>
      <br>
      <input type="hidden" name="id" value="{{$mReport->id}}">
      <textarea rows="10" name="rContent">{!!$mReport->report_content!!}</textarea>
      </div>
      <center><button type="submit" class=" btn btn-primary">Submit</button>
      @if($mReport->official == 1)
      <a href="{{route('meetingControllerOr')}}" class="btn btn-success">Back</a></center>
      @else
      <a href="{{route('meetingController')}}" class="btn btn-success">Back</a></center>
      @endif
    </form>

</div>
</div>
</div>
</div>
@include('includes.scripteditor')
@endsection

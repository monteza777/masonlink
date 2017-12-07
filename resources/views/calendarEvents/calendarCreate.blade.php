@extends('layout.master')
@section('title','MasonLink | Calendar Event')
@section('activeHome','active')

@section('body')

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="well">
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> -->
<div class="row text-center">
	 <form class="form-group" action="/calendarEvents" method="post">
<div class="col-md-offset-4 col-md-4">
   {{csrf_field()}}
   <fieldset>
   <div class="form-group">
    <label for="mail">Event Title</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-day"></span>
    </span>
    <input type="text" name="eventTitle" class="form-control" placeholder="Event Title" value="{{Request::old('evenTitle')}}" />  
    </div>
    </div>

    <!-- <div class="form-group">
    <label for="fullDay">Full Day Event</label>
    <span class="redColor">*</span>  -->
    <input type="hidden" name="fullDay" class="form-control" placeholder="Full Day" value="1"> 
    <!-- </div> -->

    <div class="form-group">
    <label for="startDay">Start Day</label>
    <span class="redColor">*</span>
    <div class="input-group" data-provide="datepicker">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
    <input  type="text" id="datetimepicker1" name="startDay" class="form-control" placeholder="Start Day" value="{{Request::old('startDay')}}"> 
    </div>
    </div>


    <div class="form-group">
    <label for="endDay">End Day</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
    <input type="text" id="datetimepicker2" name="endDay"  class="form-control" placeholder="End Day" value="{{Request::old('endDay')}}">
    </div>
    </div>

    <button type="submit"  class="btn btn-primary">Add Event</button>
    <a class="btn btn-success" href="/calendarEvents/show">View Events</a>
</div>

<div class="col-md-12">
   
</div>

</form> 
</div>
</div>
</div>
</div>
</div>


@endsection

@section('datepicker')
<script>
     $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'Y-m-d H:m:s'
                });
            });
       $(function () {  
                $('#datetimepicker2').datetimepicker({
                    format: 'Y-m-d H:m:s'
                });
            });
        $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'Y-m-d H:m:s'
                });
            });
</script>
@endsection



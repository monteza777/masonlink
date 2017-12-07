

@extends('layout.master')
@section('title','MasonLink | Edit Calendar Event')
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
	 <form class="form-group" action="/calendarEvents/{{$events->id}}"" method="post">
<div class="col-md-offset-4 col-md-4">
   {{csrf_field()}}
   {{method_field('PUT')}}
   <fieldset>
   <div class="form-group">
    <label for="mail">Event Title</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-day"></span>
    </span>
    <input type="text" name="update_title" class="form-control" placeholder="Event Title" value="{{$events->title}}" />  
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
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
    <input type="text" id="datetimepicker1" name="update_start" class="form-control" placeholder="Start Day" value="{{$events->start}}"> 
    </div>
    </div>

    <div class="form-group">
    <label for="endDay">End Day</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
    <input type="text" id="datetimepicker2" name="update_end" class="form-control" placeholder="End Day" value="{{$events->end}}">
    </div>
    </div>
    <input class="btn btn-primary" type="submit" name="submit" value="Update">
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



@extends('layout.master')
@section('title','MasonLink | Edit Calendar Event')
@section('activeHome','active')

@section('body')

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="well">

<div class="row text-center">
	 <form class="form-group" action="/calendarEvents/actionResponse/{{$events->id}}" method="post">
<div class="col-md-offset-4 col-md-4">
   {{csrf_field()}}
   {{method_field('PUT')}}
   <fieldset>
   <div class="form-group">
    <label for="mail">Event Title</label>
    <p>{{$events->title}}</p>  
    </div>

    <div class="form-group">
    <label for="mail">Event Start</label>
    <p>{{$events->start}}</p>  
    </div>

    <div class="form-group">
    <label for="mail">Event End</label>
    <p>{{$events->start}}</p>  
    </div>



    <input name="response" type="radio" value="go"><span><label>Go</label></span>
    <input name="response" type="radio" value="cantgo"><span>Can't Go</span><br><br>

    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
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

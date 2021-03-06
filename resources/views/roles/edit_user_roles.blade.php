@extends('layout.master')
@section('title','MasonLink | Edit Member')
@section('activeReg','active')
@section('body')


<script src="//cdnjs.cloudfare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudfare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudfare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudfare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js">
<div class="col-md-12 col-lg-12 col-sm-12">

<div class="well well-sm">

<h3 class="text-center">Edit Roles</h3>

<div class="container display-table ">
<div class="col-md-12 col-lg-12">
<fieldset>
    <form class="form-group" action="/roles/{{$roles->id}}" method="post">
   {{csrf_field()}}
    {{method_field('PUT')}}
<div class="col-md-4 col-md-offset-4">
   
    <div class="form-group">
    <label for="rolename">Enter Role Name</label>
    <span class="redColor">*</span> 

    <input type="text" name="edit_role_name" class="form-control" value="{{$roles->name}}"/> 
    </div>

    <div class="form-group">
    <label for="Description">Enter Description</label>
    <span class="redColor">*</span> 

    <input type="text" name="edit_desc" class="form-control" value="{{$roles->description}}"/> 
    </div>

    <center>
    <button type="submit"  class="btn btn-primary">Submit</button>
    <a class="btn btn-success" href="/roles">Role List</a>
</center>
</div>




</div>
<div class="col-md-12">
   
</div>

</form> 
</fieldset>
</div>
</div><!--end of display table -->
</div><!-- end of col-md-12 -->

</div><!-- end of div well -->
@endsection
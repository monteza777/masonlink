@extends('layout.master')
@section('title','MasonLink | Create Member')
@section('activeReg','active')
@section('body')

<link rel="stylesheet" href="//cdnjs.cloudfare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js">
<div class="col-md-12 col-lg-12 col-sm-12">

<div class="well well-sm">

<h3 class="text-center">User</h3>

<div class="container display-table ">
<div class="col-md-12 col-lg-12">
<fieldset>
    <form class="form-group" >
 
<div class="col-md-4 col-md-offset-4">
   
    <div class="form-group">
    <label for="rolename">First Name</label>
    <p>{{$user->firstname}}</p>
    </div>

    <div class="form-group">
    <label for="Description">Middle Name</label>
    <p>{{$user->middlename}}</p>
    </div>

    <div class="form-group">
    <label for="Description">Last Name</label>
    <p>{{$user->lastname}}</p>
    </div>

    <center>
    <a class="btn btn-success" href="/users">Users List</a>
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
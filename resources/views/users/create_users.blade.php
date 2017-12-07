@extends('layout.master')
@section('title','MasonLink | Create Member')
@section('activeReg','active')
@section('body')


<script src="//cdnjs.cloudfare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudfare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudfare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudfare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js">
<div class="col-md-12 col-lg-12 col-sm-12">

<div class="well well-sm">

<h3 class="text-center">Membership Form</h3>

<div class="container display-table ">
<div class="col-md-12 col-lg-12">
<fieldset>
    <form class="form-group" action="/users" method="post">
<div class="col-md-4">
   {{csrf_field()}}
   <fieldset>
   <div class="form-group">
    <label for="mail">Enter Email Address</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-envelope"></span>
    </span>
    <input type="email" name="email" class="form-control" placeholder="Email"/ value="{{Request::old('email')}}">  
    </div>
    </div>

    <div class="form-group">
    <label for="password">Enter Password</label>
    <span class="redColor">*</span> 
    <input type="password" name="password" class="form-control" placeholder="Password"> 
    </div>

    <div class="form-group">
    <label for="ConfirmPass">Confirm Password</label>
    <span class="redColor">*</span> 
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"> 
    </div>

    <div class="form-group">
    <label for="contactNo">Enter Contact Number</label>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-earphone"></span>
    </span>
    <input type="Text" name="contactNum" class="form-control" placeholder="Contact Number" value="{{Request::old('contactNum')}}"/>  
    </div>
    </div>

     
</div>

<div class="col-md-4">
   
    <div class="form-group">
    <label for="fname">Enter Firstname</label>
    <span class="redColor">*</span> 
    <input type="text" name="fname" class="form-control" placeholder="Firstname" value="{{Request::old('fname')}}"/> 
    </div>


    <div class="form-group">
    <label for="mname">Enter Middle Name</label>
    <div class="form-group">
   
    <input type="text" name="mname" class="form-control" placeholder="Middlename" value="{{Request::old('mname')}}"/>  
    </div>
    </div>

    <div class="form-group">
    <label for="lname">Enter Last Name</label>
    <span class="redColor">*</span> 
    <input type="text" name="lname" class="form-control" placeholder="Lastname" value="{{Request::old('lname')}}"> 
    </div>
    
</div>
<div class="col-md-4">
    
    <div class="form-group">
    <label for="title">Enter Lodge</label>
    <span class="redColor">*</span>
    <div class="input-group dropdown">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-home"></span>
    </span>

    <select name="user_lodge" class="form-control" required>
        <option value="">Select Lodge</option>
        @foreach($lodge as $lodges)
          <option value="{{ $lodges->lodge_name }}">{{ $lodges->lodge_name }}</option>
        @endforeach
    </select> 
    </div>
    </div>

    <div class="form-group">
    <label for="homeAdd">Enter Member's Title</label>
    <span class="redColor">*</span>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
    </span>

    <select name="members_title" class="form-control" required> 
        <option value="">Select Members Title</option>
        <option value="Master Mason">Master Mason</option>
        <option value="District Secretary">District Secretary</option>
        <option value="Worshipful Master">Worshipful Master</option>

    </select>
    </div>
    </div>

    <div class="form-group">
    <label for="title">Enter User Role</label>
    <span class="redColor">*</span>
    <div class="input-group dropdown">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
    </span>

    <select name="user_role" class="form-control" required>
        <option value="">Select User Role</option>
        @if ($roles->count())
            @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        @endif
    </select> 
    </div>
    </div>


    
</div>

<div class="col-md-12">
<div class="col-md-4">
<small>
    <span class="redColor">(*)</span>
    <small>Required Field</small>
    </small>

</div>
    <div class="col-md-4">
        <center>
        <button type="submit"  class="btn btn-primary">Register</button>
        <a class="btn btn-success" href="/users">Members List</a>
        </center>
    </div>
</div>

</form> 
</fieldset>
</div>
</div><!--end of display table -->
</div><!-- end of col-md-12 -->

</div><!-- end of div well -->
@endsection
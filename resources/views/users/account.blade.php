@extends('layout.master')
@section('title','MasonLink | My Account')

@section('body')

<div class="well">

<div class="container display-table">
<div class="col-md-12 col-lg-12">
<form class="form-group" action="{{route('account.save') }}" method="post" enctype="multipart/form-data">
<div class="col-md-4">
    <div class="form-group">
    <label for="fname">Enter Firstname</label>
    <span class="redColor">*</span> 
    <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{$user->firstname}}"/> 
    <input type="hidden" value="{{Session::token() }}" name="_token">
    
    </div>


    <div class="form-group">
    <label for="mname">Enter Middle Name</label>
    <div class="form-group">
   
    <input type="text" name="mname" class="form-control" placeholder="Middlename" value="{{$user->middlename}}"> 
    </div>
    </div>

    <div class="form-group">
    <label for="lname">Enter Last Name</label>
    <span class="redColor">*</span> 
    <input type="text" name="lname" class="form-control"  value="{{$user->lastname}}"> 
    </div><br>
    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Update">
</div>

<div class="col-md-4">
<div class="form-group">
    <label for="mail">Enter Email Address</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-envelope"></span>
    </span>
    <input type="email" name="email" class="form-control" value="{{$user->email}}"/>  
    </div>
    </div> 

    <div class="form-group">
    <label for="contactNo">Enter Contact Number</label>
    <span class="redColor">*</span>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-earphone"></span>
    </span>
    <input type="Text" name="contactNum"  class="form-control" value="{{$user->contact_number}}"/>  
    </div>
    </div>

    <div class="form-group">
    <label for="homeAdd">Enter Home Address</label>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-home"></span>
    </span>
    <input type="text" name="HomeAdd" class="form-control" value="{{$user->home_address}}">
    </div>
    </div><br>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for=image>Image (JPG Only)</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
    <div class="form-group text-center">
    @if(Storage::disk('local')->has($user->id.'.jpg'))
            <img height="170px" width="150px" src="{{ route('account.image', ['filename' => $user->id. '.jpg'])}}" 
            alt="" class="img-responsive img-thumbnail img-padding">
    @endif
    </div>
</div>
</form> 
</fieldset>
</div>
</div><!--end of display table -->
</div><!-- end of col-md-12 -->
</div><!-- end of div well -->
  
@endsection

   </div>
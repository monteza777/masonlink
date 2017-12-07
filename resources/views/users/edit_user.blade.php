@extends('layout.master')
@section('title','MasonLink | Edit User')

@section('body')

<div class="well">
<h3 class="text-center">Update Member</h3>

<div class="container display-table">
<div class="col-md-12 col-lg-12">
<fieldset>
    <form class="form-group" action="/users/{{$users->id}}" method="post">


<div class="col-md-4">
   
    <div class="form-group">
    <label for="fname">Enter Firstname</label>
    <span class="redColor">*</span> 
    <input type="text" name="fname" class="form-control" placeholder="Firstname" value="{{$users->firstname}}"/> 
    </div>


    <div class="form-group">
    <label for="mname">Enter Middle Name</label>
    <div class="form-group">
   
    <input type="text" name="mname" class="form-control" placeholder="Middlename" value="{{$users->middlename}}"/>  
    </div>
    </div>

    <div class="form-group">
    <label for="lname">Enter Last Name</label>
    <span class="redColor">*</span> 
    <input type="text" name="lname" class="form-control" placeholder="Lastname" value="{{$users->lastname}}"> 
    </div><br>

    <small>
    <span class="redColor">(*)</span>
    <small>Required Field</small>
    </small>
    
</div>

<div class="col-md-4">
   {{csrf_field()}}
   {{method_field('PUT')}}
   <fieldset>
    <div class="form-group">
    <label for="homeAdd">Enter Member's Title</label>
    <span class="redColor">*</span>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-home"></span>
    </span>
    <select name="members_title" class="form-control" required> 
        <option value="{{$users->members_title}}">{{$users->members_title}}</option>
        
        @if($users->members_title == 'Master Mason')
            <option value="District Secretary">District Secretary</option>
            <option value="Worshipful Master">Worshipful Master</option>

        @elseif($users->members_title == 'District Secretary')
            <option value="Master Mason">Master Mason</option>
            <option value="Worshipful Master">Worshipful Master</option>

        @else($users->members_title == 'Worshipful Master')
        <option value="Master Mason">Master Mason</option>
        <option value="District Secretary">District Secretary</option>

        @endif

    </select>
    </div>
    </div>

    <div class="form-group">
    <label for="title">Enter Lodge</label>
    <span class="redColor">*</span>
    <div class="input-group dropdown">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-home"></span>
    </span>

    <select name="edit_user_lodge" class="form-control" required>
        @if ($lodge->count())
        @foreach($lodge as $lodges)

        <option value="{{ $lodges->lodge_name }}" {{$lodges->lodge_name == $users->user_lodge ? 'selected="selected"' : '' }}>{{ $lodges->lodge_name }}</option>

        @endforeach
        @endif
    </select> 
    </div>
    </div>

    <div class="form-group">
    <label for="title">User Role</label>
    <div class="input-group dropdown">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
    </span>
    <select name="edit_user_role" class="form-control" placeholder="Title">
      @if ($roles->count())
        @foreach($roles as $role)
          <option value="{{ $role->id }}" {{ $currentRole->id == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
        @endforeach
        @endif
    </select> 
    </div>
    </div>

     

    <center>
    <input class="btn btn-primary" type="submit" name="submit" value="Update">
    <a class="btn btn-success" href="/users">Members List</a>
</center>
</div>

<div class="col-md-4">
    

    <div class="form-group">
    <label for="contactNo">Enter Contact Number</label>
    <span class="redColor">*</span>
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-earphone"></span>
    </span>
    <input type="Text" name="contactNum" class="form-control" value="{{$users->contact_number}}"/>  
    </div>
    </div>

    <div class="form-group">
    <label for="mail">Enter Email Address</label>
    <span class="redColor">*</span> 
    <div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-envelope"></span>
    </span>
    <input type="email" name="email" class="form-control" value="{{$users->email}}"/>  
    </div>
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

<!-- 
 <div class="col-md-4 col-md-offset-4">
   <h3>Edit User</h3>
         <form action="/users/{{$users->id}}" method="post" class="form-group">
         {{csrf_field()}}
         {{method_field('PUT')}}
         <center><input class="btn btn-success" type="submit" name="submit" value="Update"><br><br>
                  <button class="btn btn-info" href="/users">Back</button> <br><br>
         </center>
         
         <input class="form-control" type="text" name="email" placeholder="Input Username" value="{{$users->email}}">
       
         
         </form>

   </div> -->
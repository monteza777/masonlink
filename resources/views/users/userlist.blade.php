@extends('layout.master')
@section('title','MasonLink | Users List')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/deleteMessage.js') }}"></script>

<div class="col-md-12 well well-lg">
{!! Form::open(['method'=>'GET','url'=>'users','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

            <div class="input-group custom-search-form">
                <input type="text" class="form-control input-group" name="search" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default-sm" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div>
{!! Form::close() !!}
@if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('District Secretary'))<span> <a href="/users/create" class="btn btn-primary btn-sm pull-right">Add</a></span>@endif
<h3 class="text-center">Members List</h3>
<p>Show Results: <strong>{{$countUsers}}</strong></p>
<div class="row table-responsive">
<table class="table table-bordered table-hover table-condensed">
  <thead>
    <th>No.</th>
    <th>Email</th>
    <th>Fullname</th>
    <th>Roles</th>
    <th>Created</th>
    <th>Updated</th>
    <th>Action</th>
  </thead>
  <tbody>

  @foreach($users as $user)
    <tr>
      <td class="text-center">{{$loop->index+1}}</td>
      <td><strong>{{$user->email}}</strong></td>
      <td>{{$user->lastname .', '. $user->firstname. ' '.$user->middlename}} </td>
      <td>
      @foreach ($user->roles as $role) 
          @if ($role->name == 'Admin')
            <p class="btn-primary btn-xs">Admin</p>
          @elseif ($role->name == 'District Secretary')
            <p class="btn-warning btn-xs">District Secretary</p>
          @elseif ($role->name == 'User')
            <p class="btn-info btn-xs">Member</p>
      @endif

      @endforeach
      </td>
      <td>{{$user->created_at}}</td>
      <td>{{$user->updated_at}}</td>
      <td>
      <ul class="list-unstyled list-inline">

          @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('District Secretary'))
           
          <li> <a href="/users/{{$user->id}}">
           <span class="btn btn-warning">View</span></a>
          </li>

          <li> <a href="{{'/users/'.$user->id.'/edit'}}">
           <span class="btn btn-success">Update</span></a>
          </li>

          <li>
           <form action="/users/{{$user->id}}" method="post" class="form-group">
            {{csrf_field()}}
             {{method_field('DELETE')}}
            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmDelete();">
            </form>
          </li>

          @else
          <li> <a href="/users/{{$user->id}}">
           <span class="btn btn-warning">View</span></a>
          </li>
          @endif
      </ul>
      </td>
    </tr>   

   @endforeach

  </tbody>
</table>
<div class="text-center"> 
{{$users->links()}}
</div>
</div>
</div>

    
@endsection
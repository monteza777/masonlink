@extends('layout.master')
@section('title','MasonLink | Roles')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/deleteMessage.js') }}"></script>

<div class="col-md-offset-1 col-md-10 well well-lg">
@if(Auth::user()->hasRole('Admin'))<span> <a href="/roles/create" class="btn btn-default pull-right glyphicon glyphicon-option-vertical"></a></span>@endif
<h3 class="text-center">Role List</h3>
<div class="row table-responsive">
<table class="table table-bordered table-hover table-condensed">
  <thead>
    <th>Created At</th>
    <th>Name</th>
    <th>Description</th>
    <th>Action</th>
  </thead>
  <tbody>

  @foreach($roles as $role)
    <tr>
      <td>{{$role->created_at}}</td>
      <td>{{$role->name}} </td>
      <td>{{$role->description}} </td>
      <td>
      <ul class="list-unstyled list-inline">

          @if(Auth::user()->hasRole('Admin'))
          <li> <a href="/roles/{{$role->id}}">
           <span class="btn btn-warning">View</span></a>
          </li>  
           
          <li> <a href="{{'/roles/'.$role->id.'/edit'}}">
           <span class="btn btn-success">Update</span></a>
          </li>

          <li>
           <form action="/roles/{{$role->id}}" method="post" class="form-group">
            {{csrf_field()}}
             {{method_field('DELETE')}}
            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirmDelete();">
            </form>
          </li>
          @else
         
          @endif
      </ul>
      </td>
    </tr>   

   @endforeach

  </tbody>
</table>
<div class="text-center"> 
</div>
</div>
</div>

    
@endsection
@extends('layout.master')
@section('title','MasonLink | Lodges')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/deleteMessage.js') }}"></script>

<div class="col-md-offset-1 col-md-10 well well-lg">
@if(Auth::user()->hasRole('Admin'))<span> <a href="/lodge/create" class="btn btn-default pull-right glyphicon glyphicon-option-vertical"></a></span>@endif
<h3 class="text-center">Lodge List</h3>
<div class="row table-responsive">
<table class="table table-bordered table-hover table-condensed">
  <thead>
    <th>Created At</th>
    <th>Lodge Name</th>
    <th>Lodge Address</th>
    <th>Contact Number</th>
    <th>Lodge Logo</th>
    <th>Action</th>
  </thead>
  <tbody>
  <label>Total Count ({{$lodges->count()}})</label>

  @foreach($lodges as $lodge)
    <tr>
      <td>{{$lodge->created_at}}</td>
      <td>{{$lodge->lodge_name}} </td>
      <td>{{$lodge->lodge_address}} </td>
      <td>{{$lodge->contact_number}} </td>
      <td><img height="150px" width="150px" src="{{ route('post.image', ['filename' => $lodge->image])}}" class="img-responsive img-circle">
     </td>
      <td>
      <ul class="list-unstyled list-inline">

          @if(Auth::user()->hasRole('Admin'))
          <li> <a href="/lodge/{{$lodge->id}}">
           <span class="btn btn-warning">View</span></a>
          </li>  
           
          <li> <a href="{{'/lodge/'.$lodge->id.'/edit'}}">
           <span class="btn btn-success">Update</span></a>
          </li>

          <li>
           <form action="/lodge/{{$lodge->id}}" method="post" class="form-group">
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
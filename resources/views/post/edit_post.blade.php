@extends('layout.master')
@section('title','MasonLink | Edit Report')
@section('activeHome','active')

@section('body')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<form action="/post/{{$postEdit->id}}/updatePost" method="post" enctype="multipart/form-data">
 {{csrf_field()}}
 {{method_field('PUT')}}
<div class="col-md-7">
<center><label for="input">Update Post</label></center>
      <textarea rows="7" name="body" class="form-control" required>{!!$postEdit->body!!}</textarea><br>
     <input type="file" name="images" class="form-control" id="images"><br>
</div>
      <div class="col-md-5 margin-top-spacing">
      <div class="well">
      <div class="dl-horizontal">
            <dt>Created at:</dt>
            <dd>{{date('M j, Y h:ia', strtotime($postEdit->created_at))}}</dd>
      </div>

      <div class="dl-horizontal">
            <dt>Updated at:</dt>
            <dd>{{date('M j, Y h:ia', strtotime($postEdit->updated_at))}}</dd>
      </div><br>
      <div class="row">
            <div class="col-md-6">
                  <a href="{{route('dashboard')}}" class="btn btn-danger pull-right">Cancel</a>
            </div>
            <div class="col-md-6">
                  <button class="btn btn-success pull-left">Save Changes</button>
            </div>
      </div>

      </div>
      </div>
</div>
</form>

</div>
</div>
</div>
@include('includes.scripteditor')
@endsection

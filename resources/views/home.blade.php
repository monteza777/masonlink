@extends('layout.master')
@section('title','MasonLink | Home')
@section('activeHome','active')

@section('body')

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="well">
	<div class="form-group">
	 <form class="form-group" action="{{route('post.create')}}" method="post" tabindex="-1" enctype="multipart/form-data">
	{{csrf_field()}}
    <textarea rows="7" name="body" class="form-control" placeholder="What's on your Mind?" required></textarea>
    <br>
    <div class="col-md-3">
     <input type="file" name="images" class="form-control" id="images"><br>
     
    </div>
     <button type="submit"  class="btn btn-primary pull-left">Create Post</button>
    <br>
     
    </div>

	</form>
    </div>
</div>
<div class="col-md-12">
	<center><h1 class="postMargin">What other People Say</h1><hr></center>

	@foreach($posts as $post)
	<div class="post col-md-12" data-postid = "{{ $post->id}}">
  <div class="postBody">
  	<div class="info postMargin justified articlePart">
    <img height="150px" width="150px" src="{{ route('post.image', ['filename' => $post->images])}}" class="img-responsive">
      <p>{{substr($post->body,0,250)}} 
      @if(strlen($post->body) > 250)
      ... <a href="{{'/comment/'.$post->id}}" class="btn btn-default btn-xs"><i>Read More</i></a>
      @endif

  	</div>
      @if(Storage::disk('local')->has(Auth::user()->id.'.jpg'))
    <img height="30px" width="30px"
     src="{{ route('account.image', ['filename' => $post->user->id. '.jpg'])}}" 
       alt=""  class="img-circle">
      @endif
      <span class="postedBy"><i>Posted by {{ $post->user->firstname." ".$post->user->lastname}}
            on {{$post->created_at->diffForHumans()}}</i>
      </span>

  	<div class="interaction postMargin link-left-margin">
       <a class="btn btn-success btn-xs" href="{{'/comment/'.$post->id}}">Comment 
       @if($post->comments()->count() == 0)
       @else
       <span class="badge">
      {{$post->comments()->count()}}
      </span>
       @endif
      </a> 

      @if(Auth::user() == $post->user)
       | <a class="btn btn-primary btn-xs" href="{{'/post/'.$post->id.'/editPost'}}">Edit</a> | 
  		<a class="btn btn-danger btn-xs" href="{{ route('post.delete', ['post_id'=> $post->id]) }}">Delete</a>
  		@endif
  		
  	</div><hr>
  	</div>
  </div>
	@endforeach

</div>
</div>
</div>
</div>



<div id="editModal" class="modal fade" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Post</h4>
        </div>
        <div class="modal-body">
         <form>
         	<div class="form-group">
         	<label for="editPost" class="">Edit your Post </label>
        <textarea rows="5" name="body" id="post-body" class="form-control modalMargin"></textarea>
    		</div>
    	</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="modal-save">Save Changes</button>
        </div>
      </div>

    </div>
  </div>

  <script>
  	var token = '{{ Session::token() }}';
    var urlEdit= '{{ route('edit')}}';
  	var urlLike= '{{ route('like')}}';
  </script>
@endsection
  
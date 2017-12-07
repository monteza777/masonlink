@extends('layout.master')
@section('title','MasonLink | Edit Report')
@section('activeHome','active')

@section('body')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<form action="/comment/{{$posthead->id}}/store" method="post">
 {{csrf_field()}}
<div class="col-md-12">
	<div class="author-info">
		@if(Storage::disk('local')->has(Auth::user()->id.'.jpg'))
    <img height="50px" width="50px"
     src="{{ route('account.image', ['filename' => $posthead->user->id. '.jpg'])}}" 
       alt=""  class="img-circle">
      @endif
	</div>
	<div class="comment-content">
      	<h4 class="text-primary ">{{$posthead->user->firstname." ".$posthead->user->lastname }}<br>
      	<small class="post-date">Date Created: {{date('M j, Y h:ia', strtotime($posthead->created_at))}} | Date Updated: {{date('M j, Y h:ia', strtotime($posthead->updated_at))}}</small></h4>
		<span class="post-body">{{ $posthead->body }}</span><br><br>
	</div>

<div class="comment">
	 <table class="table">
	 	<thead>
	 	<tr>
	 		<th width="150px">Name</th>
	 		<th width="175px">Date Created</th>
	 		<th>Comment</th>
	 		<th width="75px"></th>
	 	</tr>
	 	</thead>
	 	<tbody>
		 	@foreach($posthead->comments as $comment)
	 	<tr>
	 		<td></td>
	 		<td>{{date('M j, Y h:ia', strtotime($comment->created_at))}}</td>
	 		<td>{{$comment->comment}}</td>
	 		<td>
	 		<a href="{{route('comment.edit', $comment->id)}}" class="btn btn-primary btn-xs glyphicon glyphicon-edit"></a>
	 		<a href="#" class="btn btn-danger btn-xs glyphicon glyphicon-trash" ></a>
	 		</td>
	 	</tr>
	 	@endforeach
	 	</tbody>
	 </table>
	 <textarea placeholder="Add a Comment" rows="7" name="comment" class="form-control" required></textarea><br>
	 <button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Comment</button>
	 <a href="{{route('dashboard')}}" class="btn btn-success"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
</div>

</div>

</div>
</form>

</div>
</div>
</div>
@endsection

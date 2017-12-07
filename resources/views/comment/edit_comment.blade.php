@extends('layout.master')
@section('title','MasonLink | Edit Report')
@section('activeHome','active')

@section('body')
<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2">
	{{ Form::model($commentEdit, ['route' => ['comment.update', $commentEdit->id], 'method'=> 'PUT']) }}
		{{Form::label('Comment', 'Comment:')}}
		{{Form::textarea('comment', null, ['class' => 'form-control']) }}

		{{Form::submit('Update Comment', ['class' => 'btn btn-block text-center, btn-success', 
		'style' =>'margin-top:15px;'])}}


	{{Form::close() }}
</div>
</form>

</div>
</div>
</div>
@endsection

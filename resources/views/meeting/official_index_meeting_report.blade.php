@extends('layout.master')
@section('title','MasonLink | Meeting Report')
@section('activeHome','active')

@section('body')
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::to('src/js/vendor/tinymce/js/tinymce/deleteMessage.js') }}"></script>

<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="well">
<div class="table-responsive">
<h2 class="alert-success">OFFICIAL MEETING REPORTS</h2>
<label for="input">Minutes of Meeting Report</label><br>
{!! Form::open(['method'=>'GET','url'=>'meeting','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

            <div class="input-group custom-search-form">
                <input type="text" class="form-control input-group" name="search" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default-sm" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div><br>
            <label>Total Count ({{$reportsLists->count()}})</label>
            <br>
				@if(count($reportsLists))
				@else
	            <div class="alert-info">
					<strong>Nothing to be show</strong>
	            </div>
				@endif

{!! Form::close() !!}
<ul class="list-unstyled list-inline pull-right">
<li>
<a href="{{ route('meetingControllerOfficialCreate') }}" class="btn btn-primary btn btn-sm">
    <i class="glyphicon glyphicon-plus"></i> Create
 </a>
</li>
@if(count($meetingOnlyTrashed))
<li><a href="{{ url('meeting/trashes') }}" class="btn btn-primary btn btn-sm">
    <i class="glyphicon glyphicon-trash"></i> Trashed <span class="badge">{{count($meetingOnlyTrashed)}}</span>
    </a>
</li>
@endif
</ul>
<table class="table table-bordered table-hover table-condensed">
<thead>
    <th class="text-center">No.</th>
    <th class="text-center">Title</th>
    <th class="text-center">Created At</th>
    <th class="text-center">Updated At</th>
    <th class="text-center">Action</th>
</thead>
<tbody>
@foreach($reportsLists as $reportsList)

<tr>
<td class="text-center">{{$loop->index+1}}</td>
<td>{{$reportsList->report_title}}</td>
<td>{{date('M j, Y h:ia', strtotime($reportsList->created_at))}}</td> <!-- j stands for day without Leading ZERO's unlike d -->
<td>{{date('M j, Y h:ia', strtotime($reportsList->updated_at))}}</td> <!-- j stands for day without Leading ZERO's unlike d -->
<td class="text-center">
<ul class="list-unstyled list-inline">
	<li><a class="btn btn-primary btn btn-sm" href="{{'/meeting/'.$reportsList->id.'/pdf'}}">
		<i class="glyphicon glyphicon-arrow-down" aria-hidden="true"></i> PDF
	</a>
	</li>
	<li> <a class="btn btn-primary btn btn-sm" href="{{'/meeting/'.$reportsList->id.'/show'}}">
       	<i class="glyphicon glyphicon-record" aria-hidden="true"></i> View
   	</a>
  	</li>
	<li> <a class="btn btn-primary btn btn-sm" href="{{'/meeting/'.$reportsList->id.'/edit'}}">
   		<i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Update
   	</a>
  	</li>
  	<li>
       {{Form::open(['action'=> ['meetingController@archive',$reportsList->id]])}}
	     <button type="submit" class="btn btn-sm btn-primary  glyphicon glyphicon-trash">
	     Archive
	     </button>
		{{Form::close()}}
  </li>
</ul>      	
</td>
</tr>   

@endforeach
</tbody>
</table>

<div class="text-center"> 
{{$reportsLists->links()}}
</div>
</div> <!-- end of table responsive -->
</div> <!-- end of div well -->
</div>
</div>
</div>
@endsection
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
<label for="input">Financial Report</label><br>
{!! Form::open(['method'=>'GET','url'=>'meeting','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

            <div class="input-group custom-search-form">
                <input type="text" class="form-control input-group" name="search" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default-sm" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div>
{!! Form::close() !!}
<ul class="list-unstyled list-inline pull-right">
<li>
<a href="{{ route('meetingControllerOr') }}" class="btn btn-primary btn btn-sm">
    <i class="glyphicon glyphicon-arrow-left"></i> Back to Reports
 </a>
</li>
<li><a href="{{ route('restoreAllFReport') }}" class="btn btn-success btn btn-sm">
    <i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Restore All</a>
</li>
</ul>

<table class="table table-bordered table-hover table-condensed">
<thead>
    <th class="text-center">No.</th>
    <th class="text-center">Title</th>
    <th class="text-center">Archived Date</th>
    <th class="text-center">Action</th>
</thead>
<tbody>
 @foreach($reportsLists as $reportsList)

    <tr>
      <td class="text-center">{{$loop->index+1}}</td>

      <td class="text-center">{{$reportsList->report_title}}</td>
      <td class="text-center">{{$reportsList->deleted_at}}</td>
	      <td class="text-center">
			<ul class="list-unstyled list-inline">
				<li><a class="btn btn-primary btn btn-sm" href="{{'/meeting/'.$reportsList->id.'/pdf'}}">
					<i class="glyphicon glyphicon-arrow-down" aria-hidden="true"></i> PDF
				</a>
				</li>
				<li> <a class="btn btn-primary btn btn-sm" href="{{'/meeting/'.$reportsList->id.'/showSoftDelete'}}">
		           	<i class="glyphicon glyphicon-record" aria-hidden="true"></i> View
	           	</a>
	          	</li>
				<li> <a class="btn btn-primary btn btn-sm" href="{{'/financialReport/'.$reportsList->id.'/restore'}}">
	           		<i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Restore
	           	</a>
	          	</li>
	          	
			</ul>      	
	      </td>
    </tr>   

   @endforeach
</tbody>
</table>

<div class="text-center"> 
</div>
</div> <!-- end of table responsive -->
</div> <!-- end of div well -->
</div>
</div>
</div>
@endsection
<div class="col-md-2 marginNone display-table-cell" id="sidemenu">
<nav class="navbar navbar-inverse nav-pills" id="rightNav">
 <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-target="#mainNavbar" data-toggle="collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
<div class="navbar-collapse collapse" id="mainNavbar">
	<div class="text-center">	

	@if(Storage::disk('local')->has(Auth::user()->id.'.jpg'))
	<img height="150px" width="150px"
	 src="{{ route('account.image', ['filename' => Auth::user()->id. '.jpg'])}}" 
     alt=""  class="img-responsive img-circle img-thumbnail img-padding">
	</div>
    @endif
	<ul class="nav nav-stacked text-center ">
	<li class="active"><a href="{{route('account')}}">
	{{ Auth::user()->firstname. " ".Auth::user()->lastname }}
		<span class=""></span></a> 
	</li>
	<li class="link "><a href="#collapse-post" data-toggle="collapse">
	<span class="glyphicon glyphicon-user"></span>
	<span class="hidden-sm hidden-xs">Membership  </span><span class="caret"></span></a>
			<ul class="collapse collapseable" id="collapse-post">
				<li><a href="/users/">View Members</a></li>
			    <li><a href="/users/create">Create New Member</a></li>
			</ul>
	</li>
	<li class="link "><a href="#calEvents" data-toggle="collapse">
	<span class="glyphicon glyphicon-calendar"></span>
	<span class="hidden-sm hidden-xs">Calendar  </span><span class="caret"></span></a>
			<ul class="collapse collapseable" id="calEvents">
				<li><a href="/calendarEvents">View Calendar Events</a></li>
			    <li><a href="/calendarEvents/show">View Events List</a></li>
			    <li><a href="/calendarEvents/create">Create Events</a></li>
			</ul>
	</li>

	<li class="link"><a href="#reportD" data-toggle="collapse">
	<span class="glyphicon glyphicon-pencil"></span>
	<span class="hidden-sm hidden-xs">Reports</span><span class="caret"></span></a>
			<ul class="collapse collapseable" id="reportD">
				<li><a href="/meeting"><span class="glyphicon glyphicon-time"></span> Minutes of Meeting</a> </li>
				<li><a href="/financialReport"><span class="glyphicon glyphicon-pencil"></span> Financial Report</a> </li>
			</ul>
	</li>
	
	</ul>
</div>
</nav>
</div>

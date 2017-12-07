@if(count($errors)>0)
<div class="row">
    <div class="col-md-6 col-md-offset-3 alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        
        </ul>
    </div>
</div>
@endif

@if(Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div>
@endif

@if(Session::has('updated'))
	<div class="alert alert-info" role="alert">
		<strong>Updated:</strong> {{ Session::get('updated') }}
	</div>
@endif

@if(Session::has('archived'))
	<div class="alert alert-warning" role="alert">
		<strong>Archived:</strong> {{ Session::get('archived') }}
	</div>
@endif

@if(Session::has('destroy'))
	<div class="alert alert-danger" role="alert">
		<strong>Deleted:</strong> {{ Session::get('destroy') }}
	</div>
@endif

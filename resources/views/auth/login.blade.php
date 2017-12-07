<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<title>@yield('title')</title>
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/css/customcss.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/css/dashboard.css')}}"></link>
<link rel="stylesheet" href="{{ asset('bootstrap/main.css') }}"></link>
 <script src="{{ asset('bootstrap/jquery2.1.4.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<!--  <script src="{!!asset('/assets/css/summernote.css')!!}"></script>
 <script src="{!!asset('/assets/js/summernote.js')!!}"></script> -->

 </head>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-md-offset-4 col-md-5">
<div class="well">
     <div class="panel-body">
     <center>
     <img  height="150px" width="250px" src="{{url('/images/4.jpg')}}" 
     class="img-responsive img-circle "><br>
     </center>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
</div>
</div>
</div>
</div>
</body>
</html>

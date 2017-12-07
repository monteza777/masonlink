<div class="row">
<nav class="navbar navbar-inverse" id="mainNavbar">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-target="#mainNavbar2" data-toggle="collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="navbar-collapse collapse" id="mainNavbar2">
    <div class="container-fluid text-center">
    <ul class="nav navbar-nav">
      <li class="@yield('activeHome') "><a href="/home"><span class="glyphicon glyphicon-home"></span> Home</a> </li>
                <li class=""><a href="#"><span class="glyphicon glyphicon-info-sign"></span> About</a> </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-earphone"></span> Contact <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li class="text-center"><a href="#">1</a></li>
                      <li class="text-center"><a href="#">2</a></li>
                      <li class="text-center"><a href="#">3</a></li>
                    </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li class="fixed-width"><a href="#"><span class="glyphicon glyphicon-bell"></span> 
                <span class="label label-warning">3</span></a>
              </li>
              <li class="fixed-width"><a href="#"><span class="glyphicon glyphicon-envelope"></span> 
                <span class="label label-info">2</span></a>
              </li>
    <!--  <li class="  @yield('activesignIn')"><a href="/login"><span class="glyphicon glyphicon-user"></span> Sign-In </a></li> -->
      @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
       @else
     <li class="dropdown">
          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="true">
              {{ Auth::user()->firstname. " ".Auth::user()->lastname }} <span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu" >
              <li><a href="{{route('account') }}"> My Account</a></li>
              <li>
                  <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
        @endif
          </ul>
       </li>

    </ul>
    </div>
  </div>
</nav>
</div> <!-- end of 2nd row -->

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{url('/dashboard')}}" class="navbar-brand">{{Config::get('ref.TITLE')}}</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          @if(Auth::user())
            <ul class="nav navbar-nav">
              <li class=""><a href="{{url('dashboard')}}">All Articles <span class="sr-only">(current)</span></a></li>
              <li class=""><a href="{{url('notes')}}">Own Articles <span class="sr-only">(current)</span></a></li>
              <li class=""><a href="{{url('types')}}">Categories <span class="sr-only">(current)</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{url('logout')}}">Logout</a></li>
            </ul>
          @else
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{url('login')}}">Login</a></li>
            </ul>
          @endif
        </div>
        
      </div>
    </div>
<div class="top-container">
  <div class="row" style="width: 100%">
    <div class="col-sm-6">
      <a href="http://www.sistemas.frba.utn.edu.ar/" id="top-logo"></a>
    </div>
    <div class="col-sm-6">
      <div class="top-social">
        <a class="top-btn" href="https://twitter.com/disifrba" target="_blank">
          <span class="fa fa-twitter"></span>
        </a>
        <a class="top-btn" href="http://www.linkedin.com/pub/prensa-utn-buenos-aires/2b/1a3/967" target="_blank">
          <span class="fa fa-linkedin"></span>
        </a>
        <a class="top-btn" href="https://www.youtube.com/user/utnbuenosaires1" target="_blank">
          <span class="fa fa-youtube"></span>
        </a>
      </div>
    </div>
  </div>      
</div>
<div class="navbar navbar-expand-md navbar-dark" style="background: #24292d;position: fixed;width: 100%;top:107px; z-index: 10">
      <a class="navbar-brand" href="/">Lost & Found</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          
          @auth
              
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/items/create">Nuevo Item</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reportes">Reportes</a>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto" style="margin-right: 30px">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01" style="left: -120px;">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
                  <a class="dropdown-item" href="/resetPassword">Cambiar Contraseña</a>
                </div>
              </li>
              <li class="nav-item">
                <a style="display: @if(!auth()->guard()->user()->esAdmin){{'none'}} @else {{'inherit'}} @endif" class="nav-link" href="{{route('register')}}">Registrar</a>
              </li>
              <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            
        </ul>

        @endauth


        @guest
          <ul class="navbar-nav mr-auto"></ul>
          
          <ul class="navbar-nav ml-auto">  
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
          </ul>

        @endguest
        
{{--         <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          
        </form> --}}
        
      </div>
</div>




               {{-- Dropdown menu --}}

{{--           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> --}}
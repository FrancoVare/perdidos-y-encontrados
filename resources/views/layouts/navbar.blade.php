<div class="navbar navbar-expand-md navbar-dark fixed-top" style="background: #24292d">
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
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
                  <a class="dropdown-item" href="/resetPassword">Cambiar Contraseña</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="@if(auth()->guard()->user()->firstLogin){{'/resetPassword'}} @else {{route('register')}} @endif">Registrar</a>
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
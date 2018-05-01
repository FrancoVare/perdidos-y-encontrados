@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
  <div class="col-sm-5">
  	<h1>Agregar sede</h1>
  	
	<div class="container">
		<hr>
		<form method="post" action="/sedes">
		@csrf

		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control{{ $errors->has('nombre-sede') ? ' is-invalid' : '' }}" id="nombre-sede" name="nombre-sede" >
		    @if ($errors->has('nombre-sede'))
                                    <span class="invalid-feedback">
                                        <strong>Debe darle un nombre a la sede</strong>
                                    </span>
                                @endif
		 </div>
		 <div class="form-group">
		    <label for="direccion">Direccion:</label>
		    <input type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" id="direccion" name="direccion" >
		    @if ($errors->has('direccion'))
                                    <span class="invalid-feedback">
                                        <strong>Debe darle una direccion a la sede</strong>
                                    </span>
                                @endif
		 </div>

		<div class="form-group">
			 <button type="submit" class="btn btn-primary">Agregar</button>
		</div>
		
	</form>
	</div>
  </div>
  <div class="col-sm-5">
  	<h1>Eliminar sede</h1>
  	
  	<div class="container">
  		<hr>
  		<form method="post" action="/sedes/destroy">
		@csrf

		<div class="form-group">
			<select class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" style="width: 100%" size="10">

			@foreach($sedes as $sede)

	        <option value="{{$sede->id}}">{{$sede->nombre}}</option>

	        @endforeach
			
		</select>
		@if ($errors->has('nombre'))
                                    <span class="invalid-feedback">
                                        <strong>Seleccione una sede</strong>
                                    </span>
                                @endif
		</div>

		<div class="form-group">
			 <button type="submit" class="btn btn-primary">Eliminar</button>
		</div>
		
	</form>
  	</div>
  </div>
</div>



	

          

{{--           <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav> --}}


@endsection
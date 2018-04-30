@extends('layouts.master')

@section('content')

<div class="row">
  <div class="column">
  	<h1>Agregar Prueba</h1>
  	
	<div class="container">
		<hr>
		<form method="post" action="/pruebas">
		@csrf

		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" >
		    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
		 </div>

		<div class="form-group">
			 <button type="submit" class="btn btn-primary">Agregar</button>
		</div>
		
	</form>
	</div>
  </div>
  <div class="column" style="border-left:1px solid gray">
  	<h1>Eliminar Prueba</h1>
  	
  	<div class="container">
  		<hr>
  		<form method="post" action="/pruebas/destroy">
		@csrf

		<div class="form-group">
			<select class="form-control{{ $errors->has('nombre_prueba') ? ' is-invalid' : '' }}" id="nombre_prueba" name="nombre_prueba" style="width: 90%" size="10">

			@foreach($pruebas as $prueba)

	        <option value="{{$prueba->id}}">{{$prueba->nombre}}</option>

	        @endforeach
			
		</select>
		@if ($errors->has('nombre_prueba'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre_prueba') }}</strong>
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
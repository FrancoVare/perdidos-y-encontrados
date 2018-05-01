@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
  <div class="col-sm-5">
  	<h1>Agregar Tag</h1>
  	
	<div class="container">
		<hr>
		<form method="post" action="/tags">
		@csrf

		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" >
		    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback">
                                        <strong>Debe darle un nombre al tag</strong>
                                    </span>
                                @endif
		</div>

		<div class="form-group">
			<label for="pruebas">Pruebas:</label>
			<select multiple class="form-control{{ $errors->has('pruebas') ? ' is-invalid' : '' }}" id="pruebas" name="pruebas[]" style="width: 100%" size="10">

				@foreach($pruebas as $prueba)

		        	<option value="{{$prueba->id}}">{{$prueba->nombre}}</option>

		        @endforeach
			
			</select>
			@if ($errors->has('pruebas'))
                                    <span class="invalid-feedback">
                                        <strong>Seleccione al menos una prueba</strong>
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
  	<h1>Eliminar Tag</h1>
  	
  	<div class="container">
  		<hr>
  		<form method="post" action="/tags/destroy">
		@csrf

		<div class="form-group">
			<select class="form-control{{ $errors->has('nombre_tag') ? ' is-invalid' : '' }}" id="nombre_tag" name="nombre_tag" style="width: 100%" size="10">

			@foreach($tags as $tag)

	        <option value="{{$tag->id}}">{{$tag->nombre}}</option>

	        @endforeach
			
		</select>
		@if ($errors->has('nombre_tag'))
                                    <span class="invalid-feedback">
                                        <strong>Seleccione un tag</strong>
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
@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
  <div class="col-sm-5">
  	<h1>Agregar Materia</h1>
  	
	<div class="container">
		<hr>
		<form method="post" action="/materias">
		@csrf

		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control{{ $errors->has('nombreMateria') ? ' is-invalid' : '' }}" id="nombreMateria" name="nombreMateria" >
		    @if ($errors->has('nombreMateria'))
                                    <span class="invalid-feedback">
                                        <strong>Debe darle un nombre a la materia</strong>
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
  	<h1>Eliminar Materia</h1>
  	
  	<div class="container">
  		<hr>
  		<form method="post" action="/materias/destroy">
		@csrf

		<div class="form-group">
			<select class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" style="width: 100%" size="10">

			@foreach($materias as $materia)

	        <option value="{{$materia->id}}">{{$materia->nombre}}</option>

	        @endforeach
			
		</select>
		@if ($errors->has('nombre'))
                                    <span class="invalid-feedback">
                                        <strong>Seleccione una materia</strong>
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
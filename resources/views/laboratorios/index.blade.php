@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
	  <div class="col-sm-5">
	  	<h1>Agregar Laboratorio</h1>
	  	
		<div class="container">
			<hr>
			<form method="post" action="/laboratorios">
			@csrf

			<div class="form-group">
			    <label for="nombre-lab">Nombre:</label>
			    <input type="text" class="form-control{{ $errors->has('nombre-lab') ? ' is-invalid' : '' }}" id="nombre-lab" name="nombre-lab" >
			    @if ($errors->has('nombre-lab'))
	                <span class="invalid-feedback">
	                    <strong>Debe darle un nombre al laboratorio</strong>
	                </span>
	            @endif
			 </div>
			 <div class="form-group">
				<label for="sede">Sede:</label>
				<select multiple class="form-control{{ $errors->has('sede') ? ' is-invalid' : '' }}" id="sede" name="sede" style="width: 100%" size="10">

					@foreach($sedes as $sede)

			        	<option value="{{$sede->id}}">{{$sede->nombre}}</option>

			        @endforeach
				
				</select>
				@if ($errors->has('sedes'))
	                                    <span class="invalid-feedback">
	                                        <strong>Seleccione al menos una sede</strong>
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
	  	<h1>Eliminar Laboratorio</h1>
	  	
	  	<div class="container">
	  		<hr>
	  		<form method="post" action="/laboratorios/destroy">
			@csrf

			<div class="form-group">
				<select class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" style="width: 100%" size="10">

				@foreach($laboratorios as $laboratorio)

		        <option value="{{$laboratorio->id}}">{{$laboratorio->nombre . ' en ' . $laboratorio->sede->nombre}}</option>

		        @endforeach
				
			</select>
			@if ($errors->has('nombre'))
	                                    <span class="invalid-feedback">
	                                        <strong>Seleccione una laboratorio</strong>
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